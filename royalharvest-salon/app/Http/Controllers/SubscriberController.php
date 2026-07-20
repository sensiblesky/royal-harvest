<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        Subscriber::firstOrCreate(['email' => $request->email]);

        return back()->with('subscribed', 'You are subscribed — welcome to Pixies!');
    }
}
