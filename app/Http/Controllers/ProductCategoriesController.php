<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::with('products')->orderBy('name', 'asc')->paginate(20);
        return view('product_categories.index')->with([
            'productCategories' => $productCategories
        ]);
    }

    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required',  
            'status'=>'required',
        ]);
        $productCategory = new ProductCategory;
        $productCategory->name= $request->input ('name');
        $productCategory->status= $request->input ('status');

        $productCategory->save();

        Session::flash('statuscode' , 'success');
        return redirect('/product/categories')->with('status' ,'CATEGORY ADDED ');
        
    }

    public function update(Request $request,  $id)
    {
        //

        $productCategory = ProductCategory::find($id);
        $productCategory->name = $request->input('name');
        $productCategory->status = $request->input('status');

        $productCategory->update();
        
        Session::flash('statuscode', 'success');
        return redirect('/product/categories')->with('status', 'Category has been updated');

    }

    public function destroy($id)
    {
        //
        $productCategory = ProductCategory::findorfail($id);
        $productCategory->delete();

        return redirect('/product/categories')->with('status', 'Category has been deleted');

    }



}
