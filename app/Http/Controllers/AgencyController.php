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
  
        $agency = Agency::orderBy('created_at', 'DESC')->paginate(10);
        return view('agency.index', compact('agency'));
    }
    
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the highest ID
        $highest = DB::table('agency')->select('agencyID')->orderBy('agencyID', 'desc')->first();
        $nextID = $highest ? intval(substr($highest->agencyID, 2)) + 1 : 1;
        $agencyID = str_pad($nextID, 3, '0', STR_PAD_LEFT);
        $agencyID = "ag" . $agencyID;
    
        return view('agency.create', compact('agencyID'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgencyRequest $request)
    {
        Agency::create($request->validated());
        return redirect()->route('agency')->with('success', 'Agency added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $agencyID)
    {
        $agency = Agency::findOrFail($agencyID);
  
        return view('agency.show', compact('agency'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $agencyID)
    {
        $agency = Agency::findOrFail($agencyID);
    
        return view('agency.edit', compact('agency'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgencyRequest $request, string $agencyID)
    {
        $agency = Agency::findOrFail($agencyID);
    
        $agency->update($request->validated());
    
        return redirect()->route('agency')->with('success', 'Agency updated successfully');
    }

     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $agencyID)
    {
        $agency = Agency::findOrFail($agencyID);
    
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
    public function unarchive(Request $request, $agencyID)
    {
        $agency = Agency::withTrashed()->findOrFail($agencyID);
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

        Agency::whereIn('agencyID', $selected)->restore();

        return redirect()->back()->with('success', 'Agency restored successfully');
    }

    
}
