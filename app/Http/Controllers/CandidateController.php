<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
   
    public function index()
    {
        return view('components.admin.candidates.candidates');
    }

    /**
     * Show the form for creating a new resource.
     */
     public function apply(Request $request)
    {
        $validated = $request->validate([
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:13',
                'regex:/^(?=.*\d)[A-Za-z0-9][A-Za-z0-9]{9,12}$/'
            ],
            'programme_id' => 'nullable|exists:programmes,id',
        ]);

        $candidateCreated= Candidate::create($validated);

        return redirect()->back()->with('message', 'You have successfully Apply for '.$candidateCreated->programme->name);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function status(Candidate $candidate){
       $candidate->isActive=!$candidate->isActive;
       $candidate->update();
      return  redirect()->back()->with('message', 'Status Changed Successfully!');

    }
    public function clear(){
        Candidate::truncate();
      return  redirect()->back()->with('message', 'Deleted successfully ');

    }


   
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
      return  redirect()->back()->with('message', 'Deleted successfully ');
    }
}
