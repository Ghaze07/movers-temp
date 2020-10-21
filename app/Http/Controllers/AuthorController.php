<?php

namespace App\Http\Controllers;

use App\Author;
use App\Blog;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('blogs')->orderBy('name_en', 'asc')->paginate(20);
        return view('author.index')->with([
            'authors' => $authors
        ]);
    }
}
