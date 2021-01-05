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
        $services = Service::where('status', 1)->get();

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
