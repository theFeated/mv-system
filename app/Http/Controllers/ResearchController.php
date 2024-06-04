<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\College;
use App\Models\Researcher;
use App\Models\Agency;
use App\Models\Roles;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;

use App\Http\Requests\Research\StoreResearchRequest;
use App\Http\Requests\Research\UpdateResearchRequest;

class ResearchController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $research = Research::orderBy('created_at', 'DESC')->get();
        return view('staff.views.research.index', compact('research'));
    }    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colleges = College::all();
        $researchers = Researcher::all();
        $agencies = Agency::all();

        return view('staff.views.research.create', compact('colleges', 'researchers', 'agencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResearchRequest  $request)
    {

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        // Convert 'true' or 'false' string to boolean value
        $request->merge(['internalFund' => $request->has('internalFund')]);
    
        $research = Research::create($request->validated());
    
        return redirect()->route('research')->with('success', 'Research added successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $research = Research::findOrFail($id);
        $college = College::find($research->collegeID);
        $researcher = Researcher::find($research->researcherID);
        $agency = Agency::find($research->agencyID);        
        $roles = Roles::find($research->roleID);
        $researchteam = ResearchTeam::where('researchID', $id)->get();
        $monitorings = Monitorings::where('researchID', $id)->get();
        $externalfunds = ExternalFunds::with('agency')
        ->where('researchID', $id)
        ->get();

        return view('staff.views.research.show', compact('research', 'college', 'researcher', 'agency', 'roles',
         'researchteam', 'monitorings','externalfunds'));
    }

    /**
     * Show form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $research = Research::findOrFail($id);
        $colleges = College::all(); 
        $researchers = Researcher::all(); 
        $agencies = Agency::all(); 

        return view('staff.views.research.edit', compact('research', 'colleges', 'researchers', 'agencies'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResearchRequest $request, string $id)
    {
        $research = Research::findOrFail($id);
    

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $request->merge(['internalFund' => (bool)$request->input('internalFund')]);
        $research->update($request->validated());
    
        return redirect()->route('research')->with('success', 'Research updated successfully');
    }
    
     /**
     * Archived the specified resource in storage.
     */
    public function destroy(Request $request, string $id)
    {
        $research = Research::findOrFail($id);
    
        $research->delete();
    
        return redirect()->route('research')->with('success', 'Research archived successfully');
    }
  
    /**
     * Go to archived pages.
     */
    public function restore()
    {
        $archived = Research::onlyTrashed()->get();
        $archivedAssigned = ResearchTeam::onlyTrashed()->get();
        $monitorings = Monitorings::onlyTrashed()->get();
        $externalFunds = ExternalFunds::onlyTrashed()->get();
        return view('staff.views.research.restore', compact('archived', 'archivedAssigned', 'monitorings', 'externalFunds'));
    }

    /**
     * Unarchived or restore an item.
     */
    public function unarchive(Request $request, $id)
    {
        $research = Research::withTrashed()->findOrFail($id);
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
    
        return redirect()->back()->with('success', 'Multiple Research Archived successfully');
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

        Research::whereIn('id', $selected)->restore();

        return redirect()->back()->with('success', 'Researches restored successfully');
    }
    
    public function destroyForever(Request $request, string $id)
    {
        try {
            $research = Research::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $research->forceDelete();
            
            return redirect()->route('research')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('research')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('research')->with('error', 'Failed to delete');
        }
    }    
}
