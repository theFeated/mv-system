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

}