<?php
 
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 use Illuminate\Support\Facades\Session;

 use App\Models\RoleResearchAssigned; 
 use App\Models\Roles;
 use App\Models\Researcher;
 use App\Models\Research;

use App\Http\Requests\RoleResearchAssigned\StoreAssignedRequest;
use App\Http\Requests\RoleResearchAssigned\UpdateAssignedRequest;
 
 class RoleResearchAssignedController extends Controller
 {
     public function index(){
         return view('roleresearchassigned.modal', compact('roles', 'researchers', 'research'));
     }
     
     public function save(StoreAssignedRequest $request)
     {
        $validatedData = $request->validated();
 
         RoleResearchAssigned::create($validatedData);
 
         return redirect()->back()->with('success', 'Saved Successfully!');
     }
    
    public function edit($roleID, $researcherID, $researchID)
    {
        $roles = Roles::all();
        $researchers = Researcher::all();
        $research = Research::all();
        
        // Find the RoleResearchAssigned instance using the provided identifiers
        $roleresearchassigned = RoleResearchAssigned::where('roleID', $roleID)
                                                    ->where('researcherID', $researcherID)
                                                    ->where('researchID', $researchID)
                                                    ->first();
    
        // Check if the instance was found
        if (!$roleresearchassigned) {
            return redirect()->back()->with('error', 'Not found.');
        }
    
        // Pass the instance to the view
        return view('roleresearchassigned.edit', compact('roles', 'researchers', 'research', 'roleresearchassigned'));
    }    
    
    public function update(UpdateAssignedRequest $request)
    {
        $roleresearchassigned = $request->roleresearchassigned;
    
        // Update role and researcher attributes of the model
        $roleresearchassigned->update([
            'roleID' => $request->roleID,
            'researcherID' => $request->researcherID,
        ]);
    
        return redirect()->back()->with('success', 'Updated Successfully!');
    }
    
    public function destroy(Request $request, string $assignedID)
    {
        $roleresearchassigned = RoleResearchAssigned::findOrFail($assignedID);
    
        $roleresearchassigned->delete();
    
        return redirect()->back()->with('success', 'Archived Successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        try {
            // Get the IDs of the selected items to delete
            $selectedItems = $request->input('selected');

            // Check if any items are selected
            if (empty($selectedItems)) {
                return redirect()->back()->with('error', 'No items selected.');
            }

            // Delete each selected item
            RoleResearchAssigned::whereIn('assignedID', $selectedItems)->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items archived successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to archive selected items: ' . $e->getMessage());
        }
    }

    public function unarchive(Request $request, $assignedID)
    {
        try {
            // Find the archived data including soft deleted records
            $roleresearchassigned = RoleResearchAssigned::withTrashed()->findOrFail($assignedID);
    
            // Check if the record is already restored
            if (!$roleresearchassigned->trashed()) {
                return redirect()->back()->with('error', 'Record is already restored.');
            }
    
            // Restore the soft deleted record
            $roleresearchassigned->restore();
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Data restored successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to restore data: ' . $e->getMessage());
        }
    }    

    public function unarchiveMultiple(Request $request)
    {
        try {
            // Get the IDs of the selected items to unarchive
            $selectedItems = $request->input('selectedTwo');

            // Check if any items are selected
            if (empty($selectedItems)) {
                return redirect()->back()->with('error', 'No items selected.');
            }

            // Find and unarchive each selected item
            foreach ($selectedItems as $assignedID) {
                $roleresearchassigned = RoleResearchAssigned::withTrashed()->findOrFail($assignedID);

                // Check if the record is already restored
                if (!$roleresearchassigned->trashed()) {
                    return redirect()->back()->with('error', 'Record with ID ' . $assignedID . ' is already restored.');
                }

                // Restore the soft deleted record
                $roleresearchassigned->restore();
            }

            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items restored successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to restore selected items: ' . $e->getMessage());
        }
    }

    public function destroyForever(Request $request, string $assignedID)
    {
        try {
            $roleresearchassigned = RoleResearchAssigned::withTrashed()->findOrFail($assignedID);
            
            // Perform force delete
            $researoleresearchassignedrcher->forceDelete();
            
            return redirect()->route('roleresearchassigned')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('roleresearchassigned')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('roleresearchassigned')->with('error', 'Failed to delete');
        }
    }
    
 }
 