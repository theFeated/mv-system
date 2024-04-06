<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\ExternalFunds;

class ExternalFundsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('externalfunds.modal', compact('exFundID'));
    }
    
    public function save(Request $request)
    {
        // Retrieve the input data
        $exFundID = $request->input('exFundID');
        $researchID = $request->input('researchID');
        $agencyID = $request->input('agencyID');
        $contribution = $request->input('contribution');
        $purpose = $request->input('purpose');
    
        // Create a new external funds record
        $externalfunds = new ExternalFunds;
        $externalfunds->exFundID = $exFundID;
        $externalfunds->researchID = $researchID;
        $externalfunds->agencyID = $agencyID;
        $externalfunds->contribution = $contribution;
        $externalfunds->purpose = $purpose;
    
        // Save the record to the database
        $externalfunds->save();
    
        // Flash a success message and redirect back
        return redirect()->back()->with('success', 'External Funds record saved successfully!');
    }
    
    public function edit($exFundID)
    {
        // Find the external fund by its ID
        $externalFund = ExternalFunds::find($exFundID);
    
        // Check if the external fund exists
        if (!$externalFund) {
            return redirect()->back()->with('error', 'External fund not found.');
        }
    
        // Retrieve all agencies to populate the dropdown
        $agencies = Agency::all();
    
        // Pass the external fund and agencies to the view
        return view('externalfunds.edit', compact('externalFund', 'agencies'));
    }
    
    public function update(Request $request, $exFundID)
    {
        // Find the external fund model by exFundID
        $externalFund = ExternalFunds::findOrFail($exFundID);

        // Check if the model exists
        if (!$externalFund) {
            return redirect()->back()->with('error', 'External fund not found.');
        }

        // Validate the incoming request data for the external fund
        $validatedData = $request->validate([
            'researchID' => 'required',
            'agencyID' => 'required',
            'contribution' => 'required',
            'purpose' => 'required',
        ]);

        // Update the attributes of the model
        $externalFund->update($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'External fund updated successfully!');
    }

}