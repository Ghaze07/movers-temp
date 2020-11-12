<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->paginate(20);
        return view('country.index')->with([
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
            'short_name' => 'required',
            'status' => 'required',
        ]);

        $country = new Country;
        $country->name = $data['name'];
        $country->short_name = $data['short_name'];
        $country->status = $data['status'];
        $country->save();

        Session::flash('statuscode', 'success');
        return redirect('/countries')->with('status', 'Country Added Successfully.');
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
    public function update(Request $request, Country $country)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'short_name' => 'required',
            'status' => 'required',
        ]);

        $country->name = $data['name'];
        $country->short_name = $data['short_name'];
        $country->status = $data['status'];
        $country->update();

        Session::flash('statuscode', 'success');
        return redirect('/countries')->with('status', 'Country has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findorfail($id);
        $country->delete();

        return redirect('/countries')->with('status', 'Country has been deleted');
    }
}
