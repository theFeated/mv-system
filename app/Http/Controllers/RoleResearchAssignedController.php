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
     public function save(StoreAssignedRequest $request)
     {
        $validatedData = $request->validated();
 
         RoleResearchAssigned::create($validatedData);
 
         return redirect()->back()->with('success', 'Saved Successfully!');
     }
    
    public function update(UpdateAssignedRequest $request, string $id)
    {
        $assigned = RoleResearchAssigned::findOrFail($id);
    
        $assigned->update($request->validated());
    
        return redirect()->back()->with('success', 'Updated successfully');
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
            RoleResearchAssigned::whereIn('id', $selectedItems)->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items removed successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to remove selected items: ' . $e->getMessage());
        }
    }

    public function destroyForever(Request $request, string $id)
    {
        try {
            $roleresearchassigned = RoleResearchAssigned::withTrashed()->findOrFail($id);
            
            // Perform force delete
            $roleresearchassigned->forceDelete();
            
            return redirect()->back()->with('success', 'Remove successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Not found');
        } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Failed to remove');
        }
    }
    
 }
 