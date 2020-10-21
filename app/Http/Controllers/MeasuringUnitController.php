<?php

namespace App\Http\Controllers;

use App\MeasuringUnit;
use Illuminate\Http\Request;

class MeasuringUnitController extends Controller
{
    public function index()
    {
        $measuringUnits = MeasuringUnit::orderBy('name', 'asc')->paginate(20);
        return view('measuringunit.index')->with([
            'measuringUnits' => $measuringUnits
        ]);
    }
}
