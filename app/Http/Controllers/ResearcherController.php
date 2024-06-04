<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Researcher;
use App\Models\College;

use App\Http\Requests\Researcher\StoreResearcherRequest;
use App\Http\Requests\Researcher\UpdateResearcherRequest;

class ResearcherController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $researcher = Researcher::orderBy('created_at', 'DESC')->get();
        return view('editor.views.researcher.index', compact('researcher'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  
        $colleges = College::all(); 
        return view('editor.views.researcher.create', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResearcherRequest $request)
    {

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $validatedData = $request->validated();

        $researcher = Researcher::create($validatedData);

        return redirect()->route('researcher')->with('success', 'Researcher added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $researcher = Researcher::findOrFail($id);
        $college = College::find($researcher->collegeID);

        return view('editor.views.researcher.show', compact('researcher', 'college'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $researcher = Researcher::findOrFail($id);
    
        $colleges = College::all(); 

        return view('editor.views.researcher.edit', compact('researcher','colleges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResearcherRequest $request, string $id)
    {
        $researcher = Researcher::findOrFail($id);
    
        $researcher->update($request->validated());
    
        return redirect()->route('researcher')->with('success', 'Researcher updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $id)
    {
        $researcher = Researcher::findOrFail($id);
    
        $researcher->delete();
    
        return redirect()->route('researcher')->with('success', 'Researcher archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archivedColleges = Researcher::onlyTrashed()->get();
    
        return view('editor.views.researcher.restore', ['archived' => $archivedColleges]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $id)
    {
        $researcher = Researcher::withTrashed()->findOrFail($id);
        $researcher->restore();
    
        return redirect()->back()->with('success', 'Researcher restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selected = $request->input('selected', []);
    
        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one researcher to archive.');
        }    
        Researcher::destroy($selected);
    
        return redirect()->back()->with('success', 'Multiple Colleges Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one researcher to restore.');
        }

        Researcher::whereIn('id', $selected)->restore();

        return redirect()->back()->with('success', 'Colleges restored successfully');
    }

    public function destroyForever(Request $request, string $id)
    {
        try {
            $researcher = Researcher::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $researcher->forceDelete();
            
            return redirect()->route('researcher')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('researcher')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('researcher')->with('error', 'Failed to delete');
        }
    }

}
