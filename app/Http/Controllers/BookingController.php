<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    function store(Request $request)  {
        dd($request);
        return back()->with("message","Thank you!, your Booking submitted successfully!");
    }
}
