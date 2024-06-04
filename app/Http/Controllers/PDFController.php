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
        // Retrieve input values
        $reportTypes = $request->input('reportTypes', []);
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit', 10);
        $columns = $request->input('columns', []);
        $minPercentage = $request->input('minPercentage');
        $maxPercentage = $request->input('maxPercentage');
    
        // Format start and end dates
        $startDateFormatted = $startDate ? Carbon::parse($startDate)->format('M-d-Y') : null;
        $endDateFormatted = $endDate ? Carbon::parse($endDate)->format('M-d-Y') : null;
    
        // Define the filename based on the provided date range
        $filename = $startDateFormatted && $endDateFormatted
            ? "monitorings-report-{$startDateFormatted}-{$endDateFormatted}.xlsx"
            : "monitorings-report-all-time.xlsx";
    
        // Download the Excel file using the provided export class
        return Excel::download(
            new AllResearchMonitoringsExport(
                $reportTypes,
                $startDate,
                $endDate,
                $limit,
                $columns,
                $minPercentage,
                $maxPercentage
            ),
            $filename
        );
    }      
    
    public function filter()
    {
        $researches = Research::get();
        $researchIds = $researches->pluck('id');
        $assignedRoles = ResearchTeam::whereIn('researchID', $researchIds)->get();
        $monitorings = Monitorings::whereIn('researchID', $researchIds)->get();
        $exFunds = ExternalFunds::whereIn('researchID', $researchIds)->get();
        $agencyIds = $exFunds->pluck('agencyID');
        $agencies = Agency::whereIn('id', $agencyIds)->get();

        // Get unique status values from the researches and convert them to lowercase
        $statuses = $researches->pluck('status')->unique()->map(function ($status) {
            return strtolower($status);
        });
        $uniqueStatuses = $statuses->unique();

        return view('research.generatereports.filter', 
        compact('researches', 'assignedRoles', 'monitorings', 'exFunds', 'agencies' , 'uniqueStatuses'));
    }

    
}
