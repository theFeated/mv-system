<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Monitorings;

use App\Http\Requests\Monitorings\StoreMonitoringRequest;
use App\Http\Requests\Monitorings\UpdateMonitoringRequest;

class MonitoringsController extends Controller
{

    public function save(StoreMonitoringRequest $request)
    {

        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $validatedData = $request->validated();
    
        Monitorings::create($validatedData);
    
        return redirect()->back()->with('success', 'Monitorings record saved successfully!');
    }

    public function update(UpdateMonitoringRequest $request, string $id)
    {
        $monitoring = Monitorings::findOrFail($id);
    
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $monitoring->update($request->validated());
    
        return redirect()->back()->with('success', 'Updated successfully');
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
            Monitorings::whereIn('id', $selectedItems)->delete();
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items removed successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to remove selected items: '. $e->getMessage());
        }
    }
    
    public function destroyForever(Request $request, $id)
    {
        try {
            $monitoring = Monitorings::withTrashed()->findOrFail($id);
    
            // Perform force delete
            $monitoring->forceDelete();
    
            return redirect()->back()->with('success', 'Remove successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove');
        }
    }

}