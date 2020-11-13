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
        $regions = Region::with('country')->orderBy('country_id', 'asc')
                                                    ->orderBy('name', 'asc')->paginate(20);
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();
        return view('region.index')->with([
            'regions' => $regions,
            'countries' => $countries
        ]);
    }

    public function setCities(Region $region)
    {
        return $region->citiesOrderByNameASC;
    }
}
