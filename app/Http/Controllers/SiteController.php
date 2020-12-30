<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Region;
use App\Product;
use App\Service;
use App\CartItem;
use App\FarmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        // $blogs = Blog::topFive();
        $services = Service::where('status', 1)->get();
        // $cartItems = array();
        // $sessionItems = array();
        // $regions = Region::where('status', 1)->get();
        // if (Auth::user()) {
        //     $authenticated = 1;
        //     // not checking where not checkout yet
        //     $cartItems = CartItem::with('farmProduct.product')->where('user_id', Auth::user()->id)->get();
        // } else {
        //     $authenticated = 0;
        //     if (session('cartItems')) {
        //         foreach (session('cartItems') as $cartItem) {
        //             foreach ($cartItem as $farm_product_id => $quantity) {
        //                 // for product name and unit price
        //                 $FarmProduct = FarmProduct::with('product')->where('id', $farm_product_id)->first();
        //                 $sessionItem = ['farm_product' => $FarmProduct, 'quantity' => $quantity];
        //                 array_push($sessionItems, $sessionItem);
        //             }
        //         }
        //     }
        // }

        return view('site.index')->with([
        
            'services' => $services
        ]);
    }

    public function dashboard()
    {
        return view('site.dashboard');
    }
    public function settings()
    {
        return view('auth.passwords.changePassword');
    }

}
