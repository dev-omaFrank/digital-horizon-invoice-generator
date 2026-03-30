<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\PaystackService;
use App\Services\PaystackWebhookService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct(protected PaystackService $paystack){}

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
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'amount' => ['required', 'numeric', 'min:2000'],
            'cardholder_name' => ['required', 'string']
        ]);

        $reference = uniqid('pay_');

        $response = $this->paystack->initializeTransaction([
            'email' => $validated['email'],
            'amount' => $validated['amount'] * 100, // Kobo to naira
            'reference' => $reference,
            'first_name' => $validated['cardholder_name'],
            'plan' => 'PLN_gkr6p0djrhmtrcz',
            'callback_url' => route('payments.callback'),
        ]);

        if (!$response['status']) {
            return back()->withErrors('Unable to initialize payment');
        }

        return redirect($response['data']['authorization_url']);
    }

    public function callBack(Request $request)
    {
        $reference = $request->query('reference');

        if(!$reference){
            return redirect()->route('payments.failed');
        }

        $response = $this->paystack->verifyTransaction($reference);

        if(!$response['status'] || $response['data']['status'] !== 'success')
        {
            return redirect()->route('payments.failed');
        }

        return redirect()->route('payments.success');
    }

    public function webHook(Request $request)
    {
        
        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();

        if ($signature !== hash_hmac('sha512', $payload, config('services.paystack.secret_key')))
        {
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
