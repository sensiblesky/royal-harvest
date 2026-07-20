<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $cleaned = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'body' => 'required|string|max:2000',
        ]);

        Contact::create($cleaned);

        return back()->with('message', 'Thank you for reaching out — we will reply shortly.');
    }
}
