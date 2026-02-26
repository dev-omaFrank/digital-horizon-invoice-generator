<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\BusinessModel;
use App\Models\ClientModel;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Spatie\Browsershot\Browsershot;

class invoiceController extends Controller
{
     public function getClientsAndBusinesses()
    {
        $clients = ClientModel::where('user_id', auth()->id())
        ->orderBy('client_name')
        ->select('id', 'client_name', 'client_email')
        ->get();

        $businesses = BusinessModel::where('user_id', auth()->id())
        ->orderBy('business_name')
        ->select('id', 'business_name', 'business_email')
        ->get();

        return view('invoices.create', compact('clients', 'businesses'));
    }

    public function createInvoice(InvoiceRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function() use ($data){
            $year = Carbon::parse($data['issue_date'])->year();

            //format inv number
            $lastInvoice = Invoice::where('business_id', $data['business_id'])
                ->whereYear('issue_date', $year)
                ->lockForUpdate()
                ->orderByDesc('id')
                ->first();

            if($lastInvoice){
                $lastNumber = (int) substr($lastInvoice->invoiceNumber, -5);
                $nextNumber = $lastNumber + 1;
            }else{
                $nextNumber = 1;
            }

            $formattedSequence = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

            $invoiceNumber = "INV-{$year}-{$formattedSequence}";

            //calculate monetary values
            $subtotal = collect($data['items'])->sum(function($item){
            return $item['quantity'] * $item['price'];
            });

            $taxAmount = $subtotal * ($data['tax'] / 100);

            $total = $subtotal + $taxAmount - $data['discount'];

            if($total < 0)
            {
                return back()->withErrors([
                    'discount' => 'Discount cannot exceed invoice total.'
                ])->withInput();
            }

            $invoice = Invoice::create([
                ...collect($data)->except(['items'])->toArray(),
                'user_id' => auth()->id(),
                'invoice_number' => $invoiceNumber,
                'subtotal' => round($subtotal, 2),
                'tax' => round($taxAmount, 2),
                'total' => round($total, 2),
            ]);

            foreach ($data['items'] as $item) {
                $invoice->items()->create([
                    ...$item,
                    'total' => round($item['quantity'] * $item['price'], 2),
                ]);
            }
        
            return response()->json([
                'status' => true,
                'message' => 'Invoice created successfully.'
            ]);
        });

    }
    
    public function fetchInvoices(){
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        $invoices = Invoice::with(['business', 'client'])
            ->latest()
            ->paginate(10);

        return view('pages.invoices', compact('invoices', 'userInitials'));
    }

    public function show(Invoice $invoice){
        $invoice->load(['business', 'client', 'items']);

        return view('/invoices/show', compact('invoice'));
    }

    public function updateInvoice(Invoice $invoice, Request $request){
         $validated = $request->validate([
            'status' => ['required', 'in:draft,sent,paid,partial,overdue,cancelled'],
        ]);

        $invoice->status = $validated['status'];

        $invoice->save();

        return response()->json([
            'status' => true,
            'message' => 'You have successfully updated your invoice'
        ]);
    }

    public function pdfView(Invoice $invoice)
    {
        $invoice->load(['business', 'client', 'items']);

        return view('invoices.show', compact('invoice'));
    }

    public function downloadInvoicePdf(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) {
            abort(403);
        }
        
        $invoice->load(['business', 'client', 'items']);

        $sessionName = config('session.cookie');
        $sessionValue = request()->cookie($sessionName);

        $signedUrl = URL::temporarySignedRoute(
            'invoices.pdf.view',      
            now()->addMinutes(5),     
            ['invoice' => $invoice->id]
        );

        $pdf = Browsershot::url($signedUrl)
            ->ignoreHttpsErrors()
            ->emulateMedia('print')
            ->waitUntilNetworkIdle()
            ->format('A4')
            ->pdf();

        
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                'attachment; filename="invoice-'.$invoice->invoice_number.'.pdf"'
            );
    }
}
