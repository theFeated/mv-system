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
        return redirect()->back()->with('success', 'Monitoring record saved successfully!');
    }
    
}