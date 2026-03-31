<?php

namespace App\Actions;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class HandleChargeSuccess
{
    public function execute(array $payload)
    {
        $data = $payload['data'];
        $reference = $data['reference'];

        \DB::transaction(function () use ($data, $reference) {
            $customerEmail = $data['customer']['email'];

            $customer = User::where('email', $customerEmail)->first();
            
            if (! $customer) {
                \Log::error('User not found for Paystack webhook', [
                    'email' => $customerEmail,
                    'reference' => $reference,
                ]);

                return;
            }

            $payment = Payment::firstOrCreate(
                ['paystack_reference' => $reference],
                [
                    'user_id' => $customer->id,
                    'paystack_subscription_code' => $data['customer']['customer_code'],
                    'paystack_customer_code' => $data['customer']['customer_code'],
                    'paystack_plan_code' => $data['plan']['plan_code'],
                    'amount' => $data['amount'],
                    'status' => 'success',
                    'paystack_transaction_id' => $data['id'],
                    'paystack_event' => 'charge.success',
                    'channel' => $data['channel'],
                    'fees' => $data['fees'] ?? null,
                    'paid_at' => now(),
                ]
            );

            $paidAt = Carbon::parse($data['paidAt']);

            $plan = Plan::firstOrCreate([
                'name' => $data['metadata']['cardholder_name'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'interval' => $data['plan']['interval'],
                'paystack_plan_code' => $data['plan']['plan_code']
            ]);

            $subscription = Subscription::firstOrCreate(
                ['paystack_subscription_code' => $data['customer']['customer_code']],
                [
                    'user_id' => $customer->id,
                    'plan_id' => $plan->id,
                    'status' => 'active',
                    'start_date' => $paidAt,
                    'end_date' => $paidAt->copy()->addDays(33),
                    'next_billing_date' => now()->addDays(33),
                    'last_payment_date' => now()->toDateTimeString(),
                    'paystack_subscription_code' => $data['subscription']['subscription_code'] ?? null,
                    'paystack_email_token' => $data['customer']['id'],
                    'canceled_at' => null,
                ],
            );

            
        });
    }
}
