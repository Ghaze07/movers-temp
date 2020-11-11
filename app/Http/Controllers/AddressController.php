<?php

namespace App\Http\Controllers;

use App\Address;
use App\AddressReciever;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function setSavedAddresses()
    {
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return response()->json($addresses);
    }
}
