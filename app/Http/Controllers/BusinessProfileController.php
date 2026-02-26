<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessProfileRequest;
use App\Models\BusinessModel;
use Illuminate\Support\Facades\Auth;

class BusinessProfileController extends Controller
{
    public function loadPage()
    {
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        return view('pages.settings', compact('userInitials'));

    }
    
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

    public function showBusinessProfile()
    {
        $user = Auth::user();
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        $businesses = $user->businesses()
            ->withCount('invoices')
            ->withSum('invoices', 'total')
            ->with(['invoices:id,business_id,currency'])
            ->paginate(10);
        return view('pages.business-profile', compact('businesses', 'userInitials'));
    }
}
