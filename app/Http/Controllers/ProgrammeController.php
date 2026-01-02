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

    public function remove(Programme $programme)
    {
        $programme->delete();
        return  redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function status(Programme $programme)
    {
        $programme->isActive = !$programme->isActive;
        $programme->update();
        return redirect()->back()->with('message', 'status updated Successfully');
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

    public function update(Request $request,Programme $programme)
    {
        $validated = $request->validate([
            'name' => "required|string",
            'cost' => "required|string",
            'duration' => "required|string"
        ]);
    
        $programme->fill($validated)->update();
        return redirect()->back()->with('message', 'Programe'. $programme->name.' pdated Successfully');
    }

    public function clear()
    {
        // Programme::truncate();
        Programme::clearAll();
        return redirect()->back()->with('message', 'All Programmes Cleared Successfully');
    }
    public function restore()
    {
        Programme::clearAll();
        Programme::create(['name' => 'Starter Dreadlocks', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Advanced Dreadlocks', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Underlock Styling', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Beginner Dreadlocks', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Weaving Setup', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Hair Retouching', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Natural Hairstyles', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Knotless Braids', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Crochet Braids', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Eyelash Extensions', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Bridal Styling', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Nail Care & Design', 'cost' => '$500', 'duration' => "3 Month",]);
        Programme::create(['name' => 'Barber Services', 'cost' => '$500', 'duration' => "3 Month",]);
        return redirect()->back()->with('message', 'updated Successfully');
    }
}
