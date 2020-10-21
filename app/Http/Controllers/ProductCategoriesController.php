<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with('products')->orderBy('name', 'asc')->paginate(20);
        return view('product_categories.index')->with([
            'categories' => $categories
        ]);
    }
}
