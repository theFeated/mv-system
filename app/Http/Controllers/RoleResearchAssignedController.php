<?php
 
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 use Illuminate\Support\Facades\Session;

 use App\Models\RoleResearchAssigned; 
 use App\Models\Roles;
 use App\Models\Researcher;
 use App\Models\Research;
 
 class RoleResearchAssignedController extends Controller
 {
     public function index(){
         return view('roleresearchassigned.modal', compact('roles', 'researchers', 'research'));
     }
     
     public function save(Request $request){
        $assignedID = $request->input('assignedID');
        $roleID = $request->input('roleID');
        $researcherID = $request->input('researcherID');
        $researchID = $request->input('researchID');
    
        // Check if the role is already assigned to the research
        $existingAssignment = RoleResearchAssigned::where('roleID', $roleID)
                                                    ->where('researchID', $researchID)
                                                    ->first();
    
        // If the assignment already exists, flash an error message and redirect back
        if ($existingAssignment) {
            return redirect()->back()->with('error', 'This role is already assigned to the research.');
        }
    
        // If the assignment does not exist, create a new RoleResearchAssigned instance and save it
        $roleresearchassigned = new RoleResearchAssigned;
        $roleresearchassigned->assignedID = $assignedID;
        $roleresearchassigned->roleID = $roleID;
        $roleresearchassigned->researcherID = $researcherID;
        $roleresearchassigned->researchID = $researchID;
        $roleresearchassigned->save();
    
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
    
    public function update(Request $request, $assignedID, $researchID)
    {
        // Find the RoleResearchAssigned model by assignedID and researchID
        $roleresearchassigned = RoleResearchAssigned::where('assignedID', $assignedID)
                                                    ->where('researchID', $researchID)
                                                    ->first();
    
        // Check if the model exists
        if (!$roleresearchassigned) {
            return redirect()->back()->with('error', 'Not found. assignedID: ' . $assignedID . ', researchID: ' . $researchID);
        }
    
        // Validate the incoming request data for role and researcher
        $validatedData = $request->validate([
            'roleID' => 'required',
            'researcherID' => 'required',
        ]);
    
        // Update role and researcher attributes of the model
        $roleresearchassigned->update([
            'roleID' => $validatedData['roleID'],
            'researcherID' => $validatedData['researcherID'],
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Updated Successfully!');
    }
    
    public function destroy(Request $request, string $assignedID)
    {
        $roleresearchassigned = RoleResearchAssigned::findOrFail($assignedID);
    
        $roleresearchassigned->delete();
    
        return redirect()->back()->with('success', 'Archived Successfully!');
    }

    public function unarchive(Request $request, $assignedID)
    {
        try {
            // Find the archived data including soft deleted records
            $roleresearchassigned = RoleResearchAssigned::withTrashed()->findOrFail($assignedID);
    
            // Restore the soft deleted record
            $roleresearchassigned->restore();
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Data restored successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to restore data: ' . $e->getMessage());
        }
    }
    
    
 }
 