<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Venture;

class PageController extends Controller
{
    public function home()
    {
        $ventures = Venture::where('isActive', true)->orderBy('sort')->get();
        $posts = Blog::latest()->take(3)->get();

        return view('pages.home', compact('ventures', 'posts'));
    }

    public function about()
    {
        $ventures = Venture::where('isActive', true)->orderBy('sort')->get();

        return view('pages.about', compact('ventures'));
    }
}
