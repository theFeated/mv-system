<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
        $columns = $request->input('columns', []);
    
        $startDateFormatted = Carbon::parse($startDate)->format('M-d-Y');
        $endDateFormatted = Carbon::parse($endDate)->format('M-d-Y');
    
        if (!$startDate && !$endDate) {
            $filename = "monitorings-report-all-time.xlsx";
        } else {
            $filename = "monitorings-report-{$startDateFormatted}-{$endDateFormatted}.xlsx";
        }
    
        return Excel::download(new AllResearchMonitoringsExport($reportType, $startDate, $endDate, $limit, $columns), $filename);
    }
    
    public function filter()
    {
        $researches = Research::with(['agency', 'college'])->get();
        $assignedRoles = ResearchTeam::whereIn('researchID', $researches->pluck('id'))->get();
        $monitorings = Monitorings::whereIn('researchID', $researches->pluck('id'))->get();
        $exFunds = ExternalFunds::whereIn('researchID', $researches->pluck('id'))->get();

        return view('research.generatereports.filter', compact('researches', 'assignedRoles', 'monitorings', 'exFunds'));
    }

    
}
