<?php

namespace App\Http\Controllers;

use App\City;
use App\Region;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('region')->orderBy('region_id', 'asc')
                        ->orderBy('name', 'asc')->paginate(20);
        $regions = Region::where(['status' => 1])->orderBy('name', 'asc')->get();
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();

        return view('city.index')->with([
            'cities' => $cities,
            'regions' => $regions,
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'country' => 'required',
            'region' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        $city = new City;
        $city->name = $data['name'];
        $city->status = $data['status'];
        $city->region_id = $data['region'];
        $city->save();

        Session::flash('statuscode', 'success');
        return redirect('/cities')->with('status', 'City has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'region' => 'required',
            'country' => 'required',
            'status' => 'required',
        ]);

        $city->name = $data['name'];
        $city->region_id = $data['region'];
        $city->status = $data['status'];
        $city->update();

        Session::flash('statuscode', 'success');
        return redirect('/cities')->with('status', 'City has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findorfail($id);
        $city->delete();

        return redirect('/cities')->with('status', 'City has been deleted.');
    }

}
