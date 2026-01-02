<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{



    //
    public function index()
    {
        return view('components.admin.programmes.programmes');
    }

    public function remove($id)
    {
        Programme::findOrfail($id)->delete();
        redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function status($id)
    {
        $prog = Programme::findOrfail($id);
        $prog->isActive = !$prog->isActive;
        $prog->update();
        return redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function store(Request $request)
    {

        $cleanedData = $request->validate([
            'name' => "required|string",
            'cost' => "required|string",
            'duration' => "required|string",
        ]);
        Programme::create($cleanedData);
        return back()->with('message', "Programme created successfully!");
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => "required|string",
            'cost' => "required|string",
            'duration' => "required|string"
        ]);
        $prog = Programme::findOrfail($id);
        $prog->fill($validated)->update();
        return redirect()->back()->with('message', 'updated Successfully');
    }


  
}
