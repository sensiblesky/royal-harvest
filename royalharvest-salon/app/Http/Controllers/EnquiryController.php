<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:120',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'service' => 'nullable|string|max:120',
            'message' => 'nullable|string|max:1000',
        ]);

        Enquiry::create($data);

        return back()->with('enquiry_sent', 'Thank you! We have received your request and will call you back shortly.');
    }
}
