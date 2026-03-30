<?php
namespace App\Actions;

use App\Models\Payment;
use App\Models\User;

class HandleChargeFailed
{
    public function execute(array $payload)
    {
        $data = $payload['data'];

        Payment::firstOrCreate(
            ['paystack_reference' => $data['reference']],
            [
                'user_id' => User::where('email', $data['customer']['email'])->first()?->id,
                'subscription_id' => null,
                'amount' => $data['amount'],
                'status' => 'Failed: ' . $data['gateway_response'],
                'paystack_transaction_id' => $data['id'],
                'paystack_event' => 'charge.failed',
                'channel' => $data['channel'],
                'fees' => $data['fees'] ?? null,
                'paid_at' => now(),
            ]
        );
    }
}
?>