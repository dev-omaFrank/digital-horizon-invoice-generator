<?php
namespace App\Services;

use App\Actions\HandleChargeFailed;
use App\Actions\HandleChargeSuccess;

class PaystackWebhookService
{
    public function handle(array $payload)
    {
        \Log::info('Webhook Received', $payload);

        match ($payload['event']) {
            'charge.success' => app(HandleChargeSuccess::class)->execute($payload),
            'charge.failed' => app(HandleChargeFailed::class)->execute($payload),

            default => \Log::warning('Unhandled event', $payload),
        };
    }
}

?>