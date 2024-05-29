<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Research;
use App\Models\RoleResearchAssigned;
use App\Models\Monitorings;
use App\Models\ExternalFunds;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $research = Research::find($id);
        
        if (!$research) {
            abort(404);
        }
    
        $assignedRole = RoleResearchAssigned::where('researchID', $id)->get();
        $monitorings = Monitorings::where('researchID', $id)->get();
        $exFunds = ExternalFunds::where('researchID', $id)->get();

        $data = [
            'title' => 'Research Report',
            'date'  => date('m/d/Y'),  
            'research' => $research,
            'assignedRole' => $assignedRole,
            'monitorings'  => $monitorings,
            'exFunds' => $exFunds,
        ];
    
        $pdf = PDF::loadView('research.report', $data);
        return $pdf->stream('report.pdf');
    }
    
    
    
}
