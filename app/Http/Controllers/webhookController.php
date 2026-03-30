<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class webhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        \Log::info('PAYSTACK WEBHOOK HIT', $request->all());
        $payload = $request->all();

        switch ($payload['event']) {

            case 'charge.success':
                $data = $payload['data'];

                $reference = $data['reference'];

                if (Payment::where('paystack_reference', $reference)->exists()) {
                    return response()->json(['status' => 'This is a duplicate transaction. Initialize a new transaction to proceed.']);
                }

                $customerEmail = $data['customer']['email'];

                $customer = User::where('email', $customerEmail)->first();

                $subscription = Subscription::where(
                    'paystack_subscription_code',
                    $data['subscription']
                )->first();

                // Create payment
                $payment = Payment::firstOrCreate(
                    ['paystack_reference' => $reference],
                    [
                        'user_id' => $customer->id,
                        'subscription_id' => $subscription->id,
                        'amount' => $data['amount'],
                        'status' => 'success',
                        'paystack_reference' => $reference,
                        'paystack_transaction_id' => $data['id'],
                        'paystack_event' => 'charge.success',
                        'channel' => $data['channel'],
                        'fees' => $data['fees'] ?? null,
                        'paid_at' => now(),
                    ]
                );

                //create plan
                $plan = Plan::firstOrCreate([
                    'name' => $data['customer']['email'],
                    'amount' => ($data['plan']['amount']/100),
                    'currency' => $data['plan']['currency'],
                    'interval' => $data['plan']['interval'],
                    'paystack_plan_code' => $data['plan']['interval'],
                ]);

                // dd($payment);

                // Update subscription
                $subscription->update([
                    'last_payment_date' => now(),
                    'next_billing_date' => now()->addMonth(),
                    'status' => 'active',
                ]);
                break;
                // case charge.success ends here

            case 'charge.failed':
                $data = $payload['data'];

                $customerCode = $data['customer']['customer_code'];

                $customer = User::where('paystack_customer_code', $customerCode)->first();

                $subscription = Subscription::where(
                    'paystack_subscription_code',
                    $data['subscription']
                )->first();

                $reference = $data['reference'];

                $payment = Payment::firstOrCreate(
                    ['paystack_reference' => $reference],
                    [
                        'user_id' => $customer->id,
                        'subscription_id' => $subscription->id,
                        'amount' => $data['amount'],
                        'status' => 'Failed: ' . $data['gateway_response'],
                        'paystack_reference' => $reference,
                        'paystack_transaction_id' => $data['id'],
                        'paystack_event' => 'charge.failed',
                        'channel' => $data['channel'],
                        'fees' => $data['fees'] ?? null,
                        'paid_at' => now(),
                    ]
                );

                break;
                // charge.failed ends here
        }

        return response()->json(['status' => 'ok']);
    }
}
