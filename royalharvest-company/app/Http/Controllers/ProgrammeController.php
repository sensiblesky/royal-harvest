<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::where('isActive', true)->latest()->get();

        return view('pages.programmes', compact('programmes'));
    }

    public function apply()
    {
        $programmes = Programme::where('isActive', true)->get();

        return view('pages.apply', compact('programmes'));
    }

    public function store(Request $request)
    {
        $cleaned = $request->validate([
            'first' => 'required|string|max:80',
            'last' => 'required|string|max:80',
            'phone' => [
                'required', 'string', 'min:10', 'max:13',
                'regex:/^(?=.*\d)[A-Za-z0-9][A-Za-z0-9]{9,12}$/',
            ],
            'email' => 'nullable|email',
            'programme_id' => 'required|exists:programmes,id',
        ], [
            'phone.regex' => 'Please check your phone number and try again (format: 07XXXXXXXX).',
        ]);

        Candidate::create($cleaned);

        return back()->with('message', 'Application received! Our team will contact you shortly.');
    }
}
