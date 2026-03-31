<?php

namespace App\Services;

use App\Actions\HandleChargeFailed;
use App\Actions\HandleChargeSuccess;

class PaystackWebhookService
{
    public function handle(array $payload)
    {
        \Log::info('Webhook Received', $payload);

        try {
            match ($payload['event'] ?? null) {
                'charge.success' => app(HandleChargeSuccess::class)->execute($payload),
                'charge.failed' => app(HandleChargeFailed::class)->execute($payload),

                default => \Log::warning('Unhandled event', $payload),
            };
        } catch (\Throwable $e) {
            \Log::error('Webhook processing failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
            ]);

            // Important: still return 200 to Paystack

            return response()->json(['status' => 'ok']);
        }
    }
}
