<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('region')->orderBy('region_id', 'asc')
            ->orderBy('name', 'asc')->paginate(20);
        return view('city.index')->with([
            'cities' => $cities
        ]);
    }
}
