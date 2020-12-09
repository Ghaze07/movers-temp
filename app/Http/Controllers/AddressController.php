<?php

namespace App\Http\Controllers;

use App\City;
use App\Region;
use App\Address;
use App\FarmCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{

    public function index() {
        return view('address.index');
    }
    public function getAddresses()
    {
        $addresses = Address::where('user_id', Auth::user()->id)->with('City')->get();
        return response()->json($addresses);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'city_id' => ['required'],
            'complete_address' => ['required'],
        ]);
        Address::find($id)->update($request->all());
        return response()->json(['message' => 'Your address has been Updated.']);
    }
    public function destroy($id)
    {
        Address::find($id)->delete();
        return response()->json(['message' => 'Your address has been Deleted.']);
    }

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
    public function getRegions()
    {
        $regions = Region::where(['status' => 1])->orderBy('name', 'asc')->get();
        return response()->json($regions);
    }
    public function getCities(Request $request)
    {
        $cities = City::where('region_id', $request->region_id)->get();
        return response()->json($cities);
    }
}
