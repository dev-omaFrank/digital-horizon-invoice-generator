<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\BusinessModel;
use App\Models\ClientModel;
use Illuminate\Http\Request;

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

        if ($data) {
           dd($data);
        }else{
            dd('request not validated');
        }
    }
}
