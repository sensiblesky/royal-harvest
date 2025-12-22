<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.blogs');
    }
    public function show($id)
    {
        $blog = Blog::latest()->get();
        return view('blogs.show_blog', ['blog' => $blog]);
    }

    public function clear()
    {
        $blog = Blog::truncate();
        return back()->with('message', "successfully cleared");
    }

    public function remove(Blog $blog)
    {
        $blog->delete();
        return back()->with('message', "successfully deleted");
    }

    public function create($request)
    {
        $blog = $request->validate([
            "title" => "required|string",
            "content" => "required|string",
            "image" => "required|image"

        ]);
        return back()->with('message', "successfully created");
    }

    public function update($request, $id)
    {
        $cleaned = $request->validate([
            "title" => "required|string",
            "content" => "required|string",
        ]);
        $blog = Blog::findOrfail($id)->fill($cleaned);
        return back()->with('message', "successfully cleared");
    }
}
