<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\PaystackService;
use App\Services\PaystackWebhookService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct(protected PaystackService $paystack) {}

    public function loadBillingPage()
    {
        $invoices = Invoice::with(['business', 'client'])
            ->whereHas('business', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('billing.upgrade', compact('invoices'));
    }

    public function initializePayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => ['required', 'email'],
                'amount' => ['required', 'numeric', 'min:2000'],
                'cardholder_name' => ['required', 'string'],
            ]);

            $reference = uniqid('pay_');

            $response = $this->paystack->initializeTransaction([
                'email' => $validated['email'],
                'amount' => $validated['amount'] * 100,
                'reference' => $reference,
                'first_name' => $validated['cardholder_name'],
                'last_name' => '',
                'plan' => 'PLN_h5od9dcview7qpn' // live plan code,
                'callback_url' => route('payments.callback'),

                'metadata' => [
                    'cardholder_name' => $validated['cardholder_name'],
                    'custom_fields' => [
                        [
                            'display_name' => 'Cardholder Name',
                            'variable_name' => 'cardholder_name',
                            'value' => $validated['cardholder_name'],
                        ],
                    ],
                ],
            ]);

            // Log Paystack response for debugging
            \Log::info('Paystack Init Response', $response);

            if (!isset($response['status']) || !$response['status']) {
                \Log::error('Paystack initialization failed', [
                    'response' => $response,
                    'reference' => $reference,
                ]);

                return back()->withErrors('Unable to initialize payment');
            }

            return redirect($response['data']['authorization_url']);

        } catch (\Throwable $e) {

            \Log::error('Payment initialization exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors('Something went wrong. Please try again.');
        }
    }

    public function callBack(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('payments.failed');
        }

        $response = $this->paystack->verifyTransaction($reference);

        if (!$response['status'] || $response['data']['status'] !== 'success') {
            return redirect()->route('payments.failed');
        }

        return redirect()->route('payments.success');
    }

    public function webHook(Request $request)
    {

        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();

        if ($signature !== hash_hmac('sha512', $payload, config('services.paystack.secret_key'))) {
            abort('403', 'Invalid Signature');
        }

        app(PaystackWebhookService::class)->handle($request->all());

        return response()->json(['status' => true]);
    }

    public function success()
    {
        return view('billing.payment-success');
    }

    public function failed()
    {
        return view('billing.payment-failed');
    }
}
