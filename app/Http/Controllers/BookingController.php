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
            'fullname' => "required|string",
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:13',
                'regex:/^(?=.*\d)[A-Za-z0-9][A-Za-z0-9]{9,12}$/'
            ],
            // 'phone' => "required|integer|min:0",
            'date' => "required|string",
            'time' => "required|string",
            'service' => "required|string",
        ],
        [
            'phone.integer' => "Please check your phone number and try again (Format 07xxx)",
        ]
    
    );
        if($request['email']){
            $cleanedData['email'] =$request['email'];

        }



        $cleanedData['code'] = random_int(10000, 99999);

        $bookingInstance=Booking::create($cleanedData);
        return view('components.pages.confirm',['booking'=>$bookingInstance])->with("message", "Thank you!, your Booking submitted successfully!");
    }

    function downloadPDF($id)  {
        // Pdf::loadView("components.pages.confirm");
        $booking = Booking::findOrFail($id);
        
        $pdf = Pdf::loadView('components.pages.pdfTemplate', compact('booking'));
        
        return $pdf->download("booking-{$booking->code}.pdf");
        
    }

     public function viewPdf($id)
    {
        $booking = Booking::findOrFail($id);
        
        $pdf = Pdf::loadView('bookings.pdf', compact('booking'));
        
        return $pdf->stream("booking-{$booking->unique_code}.pdf");
    }

     public function indexApply(Request $request)
    {
        return view('components.pages.applyform');
    }
    public function storeApply()
    {

    }
    public function programme(){
        return view('components.pages.program-index');
    }
}
