<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductSource;
use Illuminate\Http\Request;

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
}
