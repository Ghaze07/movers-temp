<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->paginate(20);
        return view('country.index')->with([
            'countries' => $countries
        ]);
    }
}
