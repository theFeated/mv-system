<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Monitorings;

use App\Http\Requests\Monitorings\StoreMonitoringRequest;
use App\Http\Requests\Monitorings\UpdateMonitoringRequest;

class MonitoringsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('monitorings.modal', compact('monitoringID'));
    }
    
    public function save(StoreMonitoringRequest $request)
    {
        $validatedData = $request->validated();
    
        Monitorings::create($validatedData);
    
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

    public function update(UpdateMonitoringRequest $request, $monitoringID)
    {
        $monitoring = Monitorings::findOrFail($monitoringID);
    
        $validatedData = $request->validated();
    
        $monitoring->update($validatedData);
    
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

    public function destroyForever(Request $request, string $monitoringID)
    {
        try {
            $monitoring = Monitorings::withTrashed()->findOrFail($monitoringID);
            
            // Perform force delete
            $monitoring->forceDelete();
            
            return redirect()->route('monitoring')->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('monitoring')->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->route('monitoring')->with('error', 'Failed to delete');
        }
    }    

}