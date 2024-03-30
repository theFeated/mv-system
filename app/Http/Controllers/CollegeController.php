<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\College;


class CollegeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $college = College::orderBy('created_at', 'DESC')->get();
        return view('college.index', compact('college'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  
        return view('college.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'collegeName' => 'required|string',
            'codePrefix' => 'required|string',
            'collegeDean' => 'required|string',
        ]);
    
        try {
            $totalColleges = College::count();
            
            // Increment the total number and format it as a three-digit string
            $collegeNumber = str_pad($totalColleges + 1, 3, '0', STR_PAD_LEFT);
            
            // Generate the new collegeID
            $newCollegeID = $validatedData['codePrefix'] . $collegeNumber;
    
            // Create the college
            $college = College::create([
                'collegeID' => $newCollegeID,
                'collegeName' => $validatedData['collegeName'],
                'collegeDean' => $validatedData['collegeDean'],
            ]);
    
            return redirect()->route('college')->with('success', 'College added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add college: ' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $collegeID)
    {
        $college = College::findOrFail($collegeID);
  
        return view('college.show', compact('college'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $collegeID)
    {
        $college = College::findOrFail($collegeID);
  
        return view('college.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $collegeID)
    {
        $college = College::findOrFail($collegeID);

        $college->update($request->all());
  
        return redirect()->route('college')->with('success', 'College updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $collegeID)
    {
        $college = College::findOrFail($collegeID);
    
        $college->delete();
    
        return redirect()->route('college')->with('success', 'College archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archivedColleges = College::onlyTrashed()->get();
    
        return view('college.restore', ['archivedColleges' => $archivedColleges]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $collegeID)
    {
        $college = College::withTrashed()->findOrFail($collegeID);
        $college->restore();
    
        return redirect()->back()->with('success', 'College restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selectedColleges = $request->input('selectedColleges', []);
    
        if (empty($selectedColleges)) {
            return redirect()->back()->withErrors('Please select at least one college to archive.');
        }    
        College::destroy($selectedColleges);
    
        return redirect()->back()->with('success', 'Multiple Colleges Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selectedColleges = $request->input('selectedColleges', []);

        if (empty($selectedColleges)) {
            return redirect()->back()->withErrors('Please select at least one college to restore.');
        }

        College::whereIn('collegeID', $selectedColleges)->restore();

        return redirect()->back()->with('success', 'Colleges restored successfully');
    }

    
}
