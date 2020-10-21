<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Region;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::with(['city', 'farmProducts'])->orderBy('city_id', 'asc')
                                                    ->orderBy('name', 'asc')->paginate(20);
        return view('farm.index')->with([
            'farms' => $farms
        ]);
    }

    public function products(Farm $farm)
    {
        $farmProducts = $farm->farmProducts()->paginate(20);
        return view('farm.products')->with([
            'farm' => $farm,
            'products' => $farmProducts
        ]);
    }
}
