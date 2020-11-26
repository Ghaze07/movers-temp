<?php

namespace App\Http\Controllers;

use App\Address;
use App\AddressReciever;
use App\FarmCity;
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
    public function setDeliveryCharges($address_id)
    {
        # code...
        $address = Address::find($address_id);
        $farm_city = FarmCity::where('city_id',$address->city_id)->where('farm_id', 1)->first();
        return response()->json($farm_city);
    }
}
