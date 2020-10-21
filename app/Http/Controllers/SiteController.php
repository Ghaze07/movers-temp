<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $blogs = Blog::topFive();
        return view('site.index')->with([
            'blogs' => $blogs,
        ]);
    }

    public function dashboard()
    {
        return view('site.dashboard');
    }
}
