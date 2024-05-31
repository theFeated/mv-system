<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Research;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;
use App\Models\Agency;

use App\Exports\MonitoringsDataExport;
use App\Exports\AllResearchMonitoringsExport;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $research = Research::find($id);
        
        if (!$research) {
            abort(404);
        }
    
        $assignedRole = ResearchTeam::where('researchID', $id)->get();
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
    
        $pdf = PDF::loadView('research.generatereports.report', $data);
        return $pdf->stream('report.pdf');
    }

    public function exportExcel($id)
    {
        return Excel::download(new MonitoringsDataExport($id), 'monitorings-report.xlsx');
    }
    


    public function generateAllMonitorings(Request $request)
    {
        $reportType = $request->input('reportType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit', 10);

        return Excel::download(new AllResearchMonitoringsExport($reportType, $startDate, $endDate, $limit), 'all-monitorings-report.xlsx');
    }

    public function filter()
    {
        $researches = Research::all();
        $researchIds = $researches->pluck('id');
        $assignedRoles = ResearchTeam::whereIn('researchID', $researchIds)->get();
        $monitorings = Monitorings::whereIn('researchID', $researchIds)->get();
        $exFunds = ExternalFunds::whereIn('researchID', $researchIds)->get();
        $agencyIds = $exFunds->pluck('agencyID');
        $agency = Agency::whereIn('id', $agencyIds)->get();

        return view('research.generatereports.filter', compact('researches', 'assignedRoles', 'monitorings', 'exFunds', 'agency'));
    }

    
}
