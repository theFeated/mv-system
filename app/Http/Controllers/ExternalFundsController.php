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
    
    
}