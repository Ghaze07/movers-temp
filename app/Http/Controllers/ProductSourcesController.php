<?php

namespace App\Http\Controllers;

use App\ProductSource;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductSourcesController extends Controller
{
    public function index()
    {
        $productSources = ProductSource::with('farmProducts')
                            ->orderBy('source', 'asc')->paginate(20);
        return view('product_sources.index')->with([
            'productSources' => $productSources
        ]);
    }
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required',  
            'status'=>'required',
        ]);
        $ProductSource = new ProductSource;
        $ProductSource->source= $request->input('name');
        $ProductSource->status= $request->input('status');

        $ProductSource->save();

        Session::flash('statuscode' , 'success');
        return redirect('/product/sources')->with('status' ,'PRODUCT SOURCE ADDED SUCCESSFULLY ');
        
    }
    public function update(Request $request, $ProductSource)
    {
        //
        $ProductSource = ProductSource::find($ProductSource);
        $ProductSource->source = $request->input('name');
        $ProductSource->status = $request->input('status');

        $ProductSource->update();
        
        Session::flash('statuscode', 'success');
        return redirect('/product/sources')->with('status', 'Product Source has been updated');

    }
    public function destroy($id)
    {
        //
        $ProductSource = ProductSource::findorfail($id);
        $ProductSource->delete();
		return redirect('/product/sources')->with('status' ,'PRODUCT SOURCE DELETED SUCCESSFULLY ');
        

    }



}
