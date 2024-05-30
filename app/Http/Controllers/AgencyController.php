<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Agency;

use App\Http\Requests\Agency\StoreAgencyRequest;
use App\Http\Requests\Agency\UpdateAgencyRequest;

class AgencyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $agency = Agency::orderBy('created_at', 'DESC')->get();
        return view('agency.index', compact('agency'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agency.create');
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgencyRequest $request)
    {
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        Agency::create($request->validated());
        return redirect()->route('agency')->with('success', 'Agency added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agency = Agency::findOrFail($id);
  
        return view('agency.show', compact('agency'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agency = Agency::findOrFail($id);
    
        return view('agency.edit', compact('agency'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgencyRequest $request, string $id)
    {
        $agency = Agency::findOrFail($id);
    
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $agency->update($request->validated());
    
        return redirect()->route('agency')->with('success', 'Agency updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $id)
    {
        $agency = Agency::findOrFail($id);
    
        $agency->delete();
    
        return redirect()->route('agency')->with('success', 'Agency archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archivedAgency = Agency::onlyTrashed()->get();
    
        return view('agency.restore', ['archived' => $archivedAgency]);
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $id)
    {
        $agency = Agency::withTrashed()->findOrFail($id);
        $agency->restore();
    
        return redirect()->back()->with('success', 'Agency restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selected = $request->input('selected', []);
    
        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one agency to archive.');
        }    
        Agency::destroy($selected);
    
        return redirect()->back()->with('success', 'Multiple Agency Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one agency to restore.');
        }

        Agency::whereIn('id', $selected)->restore();

        return redirect()->back()->with('success', 'Agency restored successfully');
    }

    public function destroyForever(Request $request, string $id)
    {
        try {
            $agency = Agency::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $agency->forceDelete();
            
            return redirect()->route('agency')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('agency')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('agency')->with('error', 'Failed to delete');
        }
    }    
    
}
