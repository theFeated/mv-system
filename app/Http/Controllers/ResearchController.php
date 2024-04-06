<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\College;
use App\Models\Researcher;
use App\Models\Agency;
use App\Models\Roles;
use App\Models\RoleResearchAssigned;
use App\Models\Monitorings;
use App\Models\ExternalFunds;

class ResearchController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $research = Research::orderBy('created_at', 'DESC')->get();
        return view('research.index', compact('research'));
    }    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colleges = College::all();
        $researchers = Researcher::all();
        $agencies = Agency::all();

        // Get the highest ID
        $highestResearch = DB::table('research')->select('researchID')->orderBy('researchID', 'desc')->first();
        $nextID = $highestResearch ? intval(substr($highestResearch->researchID, 1)) + 1 : 1;
        $researchID = str_pad($nextID, 3, '0', STR_PAD_LEFT);
        $researchID = "r" . $researchID;

        return view('research.create', compact('colleges', 'researchers', 'agencies', 'researchID'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Convert 'true' or 'false' string to boolean value
        $request->merge(['internalFund' => $request->has('internalFund')]);
    
        $research = Research::create($request->all());
    
        return redirect()->route('research')->with('success', 'Research added successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $researchID)
    {
        $research = Research::findOrFail($researchID);
        $college = College::find($research->collegeID);
        $researcher = Researcher::find($research->researcherID);
        $agency = Agency::find($research->agencyID);
        $roles = Roles::find($research->roleID);
        $roleresearchassigned = RoleResearchAssigned::where('researchID', $researchID)->get();
        $monitorings = Monitorings::where('researchID', $researchID)->get();
        $externalfunds = ExternalFunds::with('agency')
        ->where('researchID', $researchID)
        ->get();

        return view('research.show', compact('research', 'college', 'researcher', 'agency', 'roles',
         'roleresearchassigned', 'monitorings','externalfunds'));
    }


    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $researchID)
    {
        $research = Research::findOrFail($researchID);
        $colleges = College::all(); 
        $researchers = Researcher::all(); 
        $agencies = Agency::all(); 

        return view('research.edit', compact('research', 'colleges', 'researchers', 'agencies'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $researchID)
    {
        $research = Research::findOrFail($researchID);
    
        $request->merge(['internalFund' => (bool)$request->input('internalFund')]);
        $research->update($request->all());          
    
        return redirect()->route('research')->with('success', 'Research updated successfully');
    }
    
     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $researchID)
    {
        $research = Research::findOrFail($researchID);
    
        $research->delete();
    
        return redirect()->route('research')->with('success', 'Research archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archived = Research::onlyTrashed()->get();
        $archivedAssigned = RoleResearchAssigned::onlyTrashed()->get();
        $monitorings = Monitorings::onlyTrashed()->get();
        $externalFunds = ExternalFunds::onlyTrashed()->get();
        return view('research.restore', compact('archived', 'archivedAssigned', 'monitorings', 'externalFunds'));
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $researchID)
    {
        $research = Research::withTrashed()->findOrFail($researchID);
        $research->restore();

        return redirect()->back()->with('success', 'Research restored successfully');
    }    
    
    /**
     * Multiple archiving.
     */
    public function destroyMultiple(Request $request)
    {
        $selected = $request->input('selected', []);
    
        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one research to archive.');
        }    
        Research::destroy($selected);
    
        return redirect()->back()->with('success', 'Multiple Researches Archived successfully');
    }

    /**
     * Multiple un-archiving.
     */
    public function unarchiveMultiple(Request $request)
    {
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->back()->withErrors('Please select at least one research to restore.');
        }

        Research::whereIn('researchID', $selected)->restore();

        return redirect()->back()->with('success', 'Researches restored successfully');
    }

}
