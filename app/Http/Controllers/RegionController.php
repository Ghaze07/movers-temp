<?php

namespace App\Http\Controllers;

use App\Region;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('region.index');
    }
    public function getRegions()
    {
        $regions = Region::with('country')->orderBy('country_id', 'asc')->orderBy('name', 'asc')->get();
        return response()->json($regions);
    }
    public function getActiveCountries()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();
        return response()->json($countries);

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'country_id' => ['required'],
            'status' => ['required'],
        ]);

        Region::create($request->all());
        return response()->json(['message' => 'Region has been Added.']);
        
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'country_id' => ['required'],
            'status' => ['required'],
        ]);
        
        Region::find($id)->update($request->all());
        return response()->json(['message' => 'Region has been Updated.']);
    }
    public function destroy($id)
    {
        Region::find($id)->delete();

        return response()->json(['message' => 'Region has been Deleted.']);
    }

    public function setCities(Region $region)
    {
        return $region->citiesOrderByNameASC;
    }
}
