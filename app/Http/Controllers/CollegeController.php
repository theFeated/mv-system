<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\College\StoreCollegeRequest;
use App\Http\Requests\College\UpdateCollegeRequest;

use App\Models\College;


class CollegeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $college = College::orderBy('created_at', 'DESC')->get();
        return view('staff.views.college.index', compact('college'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  
        return view('staff.views.college.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollegeRequest $request)
    {
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $validatedData = $request->validated();

        $college = College::create($validatedData);

        return redirect()->route('college')->with('success', 'College added successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $college = College::findOrFail($id);
  
        return view('staff.views.college.show', compact('college'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
  
        return view('staff.views.college.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollegeRequest $request, string $id)
    {
        $college = College::findOrFail($id);

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }    
    
        $college->update($request->validated());
    
        return redirect()->route('college')->with('success', 'College updated successfully');
    }
    
     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $id)
    {
        $college = College::findOrFail($id);
    
        $college->delete();
    
        return redirect()->route('college')->with('success', 'College archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archivedColleges = College::onlyTrashed()->get();
    
        return view('staff.views.college.restore', ['archivedColleges' => $archivedColleges]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $id)
    {
        $college = College::withTrashed()->findOrFail($id);
        $college->restore();
    
        return redirect()->back()->with('success', 'College restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selected = $request->input('selected', []);
    
        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one college to archive.');
        }    
        College::destroy($selected);
    
        return redirect()->back()->with('success', 'Multiple Colleges Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one college to restore.');
        }

        College::whereIn('id', $selected)->restore();

        return redirect()->back()->with('success', 'Colleges restored successfully');
    }

    public function destroyForever(Request $request, string $id)
    {
        try {
            $college = College::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $college->forceDelete();
            
            return redirect()->route('college')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('college')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('college')->with('error', 'Failed to delete');
        }
    }    
    
}
