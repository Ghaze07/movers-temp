<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where(['published' => true])->orderBy('created_at', 'desc')->get();
        return view('blog.index')->with([
            'blogs' => $blogs,
        ]);
    }

    public function show($blog)
    {
        $blog = Blog::where(['id' => $blog])
            ->orWhere(['slug' => $blog])
            ->firstOrFail();

        if( $blog->published ) {
            $blog->views++;
            $blog->save();

            return view('blog.show')->with([
                'blog' => $blog,
                'author' => $blog->author()->first(),
                'blogs' => Blog::topFive()
            ]);
        }else{
            abort(404, 'Record not found.');
        }
    }
}
