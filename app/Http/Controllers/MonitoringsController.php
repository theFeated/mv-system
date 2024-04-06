<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Monitorings;

class MonitoringsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('monitorings.modal', compact('monitoringID'));
    }
    
    public function save(Request $request){
        // Retrieve the input data
        $monitoringID = $request->input('monitoringID');
        $researchID = $request->input('researchID');
        $progress = $request->input('progress');
        $status = $request->input('status');
        $remarks = $request->input('remarks');
        $monitoringPersonnel = $request->input('monitoringPersonnel');
        $date = $request->input('date');
    
        // Create a new monitoring record
        $monitoring = new Monitorings;
        $monitoring->monitoringID = $monitoringID;
        $monitoring->researchID = $researchID;
        $monitoring->progress = $progress;
        $monitoring->status = $status;
        $monitoring->remarks = $remarks;
        $monitoring->monitoringPersonnel = $monitoringPersonnel;
        $monitoring->date = $date;
        $monitoring->save();
    
        // Flash a success message and redirect back
        return redirect()->back()->with('success', 'Monitorings record saved successfully!');
    }

    public function edit($monitoringID)
    {
        $monitoring = Monitorings::find($monitoringID);

        // Check if the monitoring exists
        if (!$monitoring) {
            return redirect()->back()->with('error', 'Monitorings not found.');
        }

        // Pass the monitoring to the view
        return view('monitorings.edit', compact('monitoring'));
    }

    public function update(Request $request, $monitoringID)
    {
        // Find the monitoring model by monitoringID
        $monitoring = Monitorings::findOrFail($monitoringID);

        // Check if the model exists
        if (!$monitoring) {
            return redirect()->back()->with('error', 'Monitorings not found.');
        }

        // Validate the incoming request data for the monitoring
        $validatedData = $request->validate([
            'progress' => 'required',
            'status' => 'required',
            'remarks' => 'required',
            'monitoringPersonnel' => 'required',
            'date' => 'required|date',
        ]);

        // Update the attributes of the model
        $monitoring->update($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Monitorings Updated Successfully!');
    }

    public function destroy(Request $request, string $monitoringID)
    {
        $monitoring = Monitorings::findOrFail($monitoringID);
    
        $monitoring->delete();
    
        return redirect()->back()->with('success', 'Archived Successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        try {
            // Get the IDs of the selected items to delete
            $selectedItems = $request->input('selectedTwo');
    
            // Check if any items are selected
            if (empty($selectedItems)) {
                return redirect()->back()->with('error', 'No items selected.');
            }
    
            // Delete each selected item
            Monitorings::whereIn('monitoringID', $selectedItems)->delete();
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items archived successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to archive selected items: ' . $e->getMessage());
        }
    }
       
    public function unarchive(Request $request, $monitoringID)
    {
        try {
            // Find the archived data including soft deleted records
            $monitoring = Monitorings::withTrashed()->findOrFail($monitoringID);
    
            // Check if the record is already restored
            if (!$monitoring->trashed()) {
                return redirect()->back()->with('error', 'Record is already restored.');
            }
    
            // Restore the soft deleted record
            $monitoring->restore();
    
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
            $selectedItems = $request->input('selectedThree');

            // Check if any items are selected
            if (empty($selectedItems)) {
                return redirect()->back()->with('error', 'No items selected.');
            }

            // Find and unarchive each selected item
            foreach ($selectedItems as $monitoringID) {
                $monitoring = Monitorings::withTrashed()->findOrFail($monitoringID);

                // Check if the record is already restored
                if (!$monitoring->trashed()) {
                    return redirect()->back()->with('error', 'Record with ID ' . $monitoringID . ' is already restored.');
                }

                // Restore the soft deleted record
                $monitoring->restore();
            }

            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items restored successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to restore selected items: ' . $e->getMessage());
        }
    }

}