<?php

namespace App\Http\Controllers;

use App\Blog;
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
