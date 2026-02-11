<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientProfileRequest;
use Illuminate\Http\Request;

class CreateClientController extends Controller
{
    public function create(StoreClientProfileRequest $request)
    {
        $data = $request->validated();

        //save data and return response
        // add error message space in add client popup
    }
}
