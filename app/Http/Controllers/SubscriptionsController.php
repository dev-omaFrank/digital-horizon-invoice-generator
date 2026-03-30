<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function loadSubscriptionsPage(){
        $userId = auth()->id();
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        return view('pages.subscriptions', compact('userInitials'));
    }
}
