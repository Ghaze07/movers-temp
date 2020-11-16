<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Product;
use App\MeasuringUnit;
use App\ProductSource;

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
        $farms=Farm::all();
        $products=Product::all();
        $productSources=ProductSource::all();
        $measuringUnits=MeasuringUnit::all();
        $farmProducts = $farm->farmProducts()->paginate(20);
        return view('farm.products', compact('products','farms','productSources','measuringUnits'))->with([
            'farm' => $farm,
            'farmProducts' => $farmProducts
        ]);
    }
}
