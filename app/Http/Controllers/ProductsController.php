<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name', 'asc')->paginate(20);
        return view('products.index')->with([
            'products' => $products
        ]);
    }
}
