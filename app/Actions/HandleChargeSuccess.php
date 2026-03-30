<?php
namespace App\Actions;

use App\Models\Payment;
use App\Models\User;

class HandleChargeSuccess
{
    public function execute(array $payload)
    {
        $data = $payload['data'];
        $reference = $data['reference'];

        \DB::transaction(function () use ($data, $reference){
            $customerEmail = $data['customer']['email'];

            $customer = User::where('email', $customerEmail)->first();

            $payment = Payment::firstOrCreate(
                ['paystack_reference' => $reference],
                [
                    'user_id' => $customer->id,
                    'subscription_id' => $data['customer']['customer_code']->id,
                    'amount' => $data['amount'],
                    'status' => 'success',
                    'paystack_transaction_id' => $data['id'],
                    'paystack_event' => 'charge.success',
                    'channel' => $data['channel'],
                    'fees' => $data['fees'] ?? null,
                    'paid_at' => now(),
                ]
            ); 
        });
    }
}

?>