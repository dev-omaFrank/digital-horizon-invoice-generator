<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessProfileRequest;
use App\Models\BusinessModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessProfileController extends Controller
{
    public function createBusiness(StoreBusinessProfileRequest $request)
    {
       $data = $request->validated();

       if($request->hasFile("businessLogo")){
        $data['business_logo'] = $request
            ->file('businessLogo')
            ->store('businessLogos', 'public');
       }


        BusinessModel::create([
            'user_id' => Auth::id(),
            'business_name' => $data['businessName'],
            'business_logo' => $data['business_logo'],
            'business_email' => $data['businessEmail'],
            'business_address' => $data['businessAddress'],
            'business_phone_no' => $data['businessPhoneNo'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'You have successfully created a business profile for ' . $data['businessName']
        ]);

    }
}
