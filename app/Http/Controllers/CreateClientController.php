<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientProfileRequest;
use App\Models\ClientModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CreateClientController extends Controller
{
    public function fetchClients()
    {
        $clients = ClientModel::withCount('invoices')
            ->withSum('invoices as total_billed', 'total')
            ->with(['invoices' => function($query){
                $query->latest()->select('id', 'client_id', 'currency');
            }])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.clients', ['clients' => $clients]);
    }

    public function createClient(StoreClientProfileRequest $request)
    {
        $data = $request->validated();

        ClientModel::create([
            'client_name' => $data['clientName'],
            'client_email' => $data['clientEmail'],
            'client_address' => $data['clientAddress'],
            'client_phone_no' => $data['clientPhoneNo'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'You have successfully created a client profile for ' . $data['clientName']
        ]);

        // add error message space in add client popup
    }
}
