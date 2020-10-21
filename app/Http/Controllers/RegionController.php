<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('country')->orderBy('country_id', 'asc')
                                                    ->orderBy('name', 'asc')->paginate(20);
        return view('region.index')->with([
            'regions' => $regions
        ]);
    }
}
