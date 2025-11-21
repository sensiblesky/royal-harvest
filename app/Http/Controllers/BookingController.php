<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    function store(Request $request)  {
        // dd($request);
         $cleanedData = $request->validate([
            'fname' => "required|string",
            'lname' => "required|string",
            'email' => "required|string",
            'phone' => "required|string",
            'date' => "required|string",
            'time' => "required|string",
        ]);



        $cleanedData['code']=random_int(10000, 99999);
         
        Booking::create($cleanedData);
        return back()->with("message","Thank you!, your Booking submitted successfully!");
    }
}
