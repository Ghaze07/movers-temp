<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name', 'asc')->paginate(20);
        $categories = ProductCategory::where(['status' => 1])->orderBy('name', 'asc')->get();
        return view('products.index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'name' => 'required',
            'product_category_id' => 'required',
            'status' => 'required',
         ]);
        
        $product = new Product;
        $product->name= $request->input ('name');
        $product->product_category_id= $request->input ('product_category_id');
        $product->status= $request->input ('status');

        $product->save();

        Session::flash('statuscode' , 'success');
        return redirect('/products')->with('status' ,'products ADDED ');


    }

    public function update(Request $request, Product $product)
    {
        //
       
        $product->name = $request->input('name');
        $product->product_category_id = $request->input('product_category_id');
        $product->status = $request->input('status');

        $product->update();
        
        Session::flash('statuscode', 'success');
        return redirect('/products')->with('status', 'Product has been updated');

    }

    public function destroy($id)
    {
        //
        $product = Product::findorfail($id);
        $product->delete();

        return redirect('/products')->with('status', 'Product has been deleted');

    }



}
