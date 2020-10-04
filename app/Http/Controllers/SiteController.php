<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Facades\SMS;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function dashboard()
    {
        return view('site.dashboard');
    }
}
