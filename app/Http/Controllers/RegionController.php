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
        $data = $this->validate($request,[
            'name' => 'required',
            'country' => 'required',
            'status' => 'required',
        ]);

        $region = new Region;
        $region->name = $data['name'];
        $region->country_id = $data['country'];
        $region->status = $data['status'];
        $region->save();

        Session::flash('statuscode', 'success');
        return redirect('/regions')->with('status', 'Region added successfully.');
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
    public function update(Request $request,  Region $region)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'country' => 'required',
            'status' => 'required',
        ]);

        $region->name = $data['name'];
        $region->country_id = $data['country'];
        $region->status = $data['status'];
        $region->update();

        Session::flash('statuscode', 'success');
        return redirect('/regions')->with('status', 'Region has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findorfail($id);
        $region->delete();

        return redirect('/regions')->with('status', 'Region has been deleted');
    }
}
