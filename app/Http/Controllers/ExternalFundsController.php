<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\ExternalFunds;

use App\Http\Requests\ExternalFunds\StoreExternalFundRequest;
use App\Http\Requests\ExternalFunds\UpdateExternalFundRequest;

class ExternalFundsController extends Controller
{
    
    public function save(StoreExternalFundRequest $request)
    {
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $validatedData = $request->validated();
 
        ExternalFunds::create($validatedData);
    
        return redirect()->back()->with('success', 'External Funds record saved successfully!');
    }

    public function update(UpdateExternalFundRequest $request, $id)
    {
        $externalFund = ExternalFunds::findOrFail($id);
    
        if (!$request->validated()) {
            return response()->json(['error' => $request->errors()], 422);
        }
    
        $validatedData = $request->validated();
    
        $externalFund->update($validatedData);
    
        return redirect()->back()->with('success', 'External fund updated successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        try {
            // Get the IDs of the selected items to delete
            $selectedItems = $request->input('selectedThree');

            // Check if any items are selected
            if (empty($selectedItems)) {
                return redirect()->back()->with('error', 'No items selected.');
            }

            // Delete each selected item
            ExternalFunds::whereIn('id', $selectedItems)->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Selected items archived successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to archive selected items: ' . $e->getMessage());
        }
    }

    public function destroyForever(Request $request, string $exFundID)
    {
        try {
            $externalFunds = ExternalFunds::withTrashed()->findOrFail($exFundID);
            
            // Perform force delete
            $externalFunds->forceDelete();
            
            return redirect()->back()->with('success', 'Deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Not found');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete');
        }
    }    

}