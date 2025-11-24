<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    function index(Request $request)
    {
        return view('components.pages.booking');
    }
    function confirm(Request $request)
    {
        return view('components.pages.confirm');
    }
    function store(Request $request)
    {
        // dd($request);
        $cleanedData = $request->validate([
            'fname' => "required|string",
            'lname' => "required|string",
            'email' => "required|string",
            'phone' => "required|string",
            'date' => "required|string",
            'time' => "required|string",
        ]);



        $cleanedData['code'] = random_int(10000, 99999);

        $bookingInstance=Booking::create($cleanedData);
        return view('components.pages.confirm',['booking'=>$bookingInstance])->with("message", "Thank you!, your Booking submitted successfully!");
    }

    function downloadPDF($id)  {
        // Pdf::loadView("components.pages.confirm");
        $booking = Booking::findOrFail($id);
        
        $pdf = Pdf::loadView('components.pages.confirm', compact('booking'));
        
        return $pdf->download("booking-{$booking->code}.pdf");
        
    }

     public function viewPdf($id)
    {
        $booking = Booking::findOrFail($id);
        
        $pdf = Pdf::loadView('bookings.pdf', compact('booking'));
        
        return $pdf->stream("booking-{$booking->unique_code}.pdf");
    }
}
