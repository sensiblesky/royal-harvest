<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->paginate(9);

        return view('pages.blogs', compact('posts'));
    }

    public function show(Blog $blog)
    {
        $related = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('pages.blog-show', compact('blog', 'related'));
    }
}
