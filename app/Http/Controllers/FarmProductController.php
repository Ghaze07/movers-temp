<?php

namespace App\Http\Controllers;

use App\FarmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FarmProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $this->validate($request,[
            'product_id' => 'required',
            'farm_id' => 'required',
            'product_source_id' => 'required',
            'measuring_unit_id' => 'required',
            'unit_price' => 'required',
            'maximum_order_quantity' => 'required',
            'minimum_order_quantity' => 'required',
            
         ]);

        $farmProducts=new FarmProduct;
        $farmProducts->product_id= $request->input('product_id');
        $farmProducts->farm_id= $request->input('farm_id');
        $farmProducts->product_source_id = $request->input('product_source_id');
        $farmProducts->measuring_unit_id = $request->input('measuring_unit_id');
        $farmProducts->unit_price = $request->input('unit_price');
        $farmProducts->maximum_order_quantity = $request->input('maximum_order_quantity');
        $farmProducts->minimum_order_quantity = $request->input('minimum_order_quantity');
        $farmProducts->save();
        Session::flash('statuscode' , 'success');
        return redirect()->route('farm.products', ['farm' => $farmProducts->farm_id])->with('status' ,'Farm Product ADDED ');
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
    public function update(Request $request, $FarmProduct)
    {
        //
        $this->validate($request,[
            'product_id' => 'required',
            'product_source_id' => 'required',
            'measuring_unit_id' => 'required',
            'unit_price' => 'required',
            'maximum_order_quantity' => 'required',
            'minimum_order_quantity' => 'required',
            'status' => 'required',
            
         ]);

        $FarmProduct = FarmProduct::find($FarmProduct);
        $FarmProduct->farm_id= $request->input('farm_id');
        $FarmProduct->product_id= $request->input('product_id');
        $FarmProduct->product_source_id = $request->input('product_source_id');
        $FarmProduct->measuring_unit_id = $request->input('measuring_unit_id');
        $FarmProduct->unit_price = $request->input('unit_price');
        $FarmProduct->maximum_order_quantity = $request->input('maximum_order_quantity');
        $FarmProduct->minimum_order_quantity = $request->input('minimum_order_quantity');
        $FarmProduct->status = $request->input('status');

        $FarmProduct->save();
        
        Session::flash('statuscode', 'success');
        return redirect()->route('farm.products', ['farm' => $FarmProduct->farm_id])->with('status' ,'Farm Product Updated ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $farm = FarmProduct::findorfail($id);
        $farm->delete();

        return redirect()->route('farm.products', ['farm' => $farm->farm_id])->with('status' ,'Farm Product Deleted ');

    }
}
