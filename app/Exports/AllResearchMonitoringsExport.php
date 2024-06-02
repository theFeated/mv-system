<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Research;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;
use App\Models\Agency;

class AllResearchMonitoringsExport implements FromView
{
    protected $reportType;
    protected $startDate;
    protected $endDate;
    protected $limit;
    protected $columns;

    public function __construct($reportType, $startDate, $endDate, $limit, $columns)
    {
        $this->reportType = $reportType;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->limit = $limit;
        $this->columns = $columns;
    }

    public function view() : View
    {
        $query = Research::query();
    
        if ($this->reportType == 'completed') {
            $query->where('status', 'Completed');
        } elseif ($this->reportType == 'ongoing') {
            $query->where('status', 'Ongoing');
        }
    
        if ($this->startDate) {
            $query->whereDate('startDate', '>=', $this->startDate);
        }
    
        if ($this->endDate) {
            $query->whereDate('endDate', '<=', $this->endDate);
        }
    
        $researches = $query->limit($this->limit)->get();
    
        // Fetch the latest monitoring for each research
        foreach ($researches as $research) {
            $research->latestMonitoring = Monitorings::where('researchID', $research->id)
                ->orderBy('created_at', 'desc')
                ->first();
        }
    
        $researchIds = $researches->pluck('id');
        $assignedRoles = ResearchTeam::whereIn('researchID', $researchIds)->get();
        $exFunds = ExternalFunds::whereIn('researchID', $researchIds)->get();
        $agencyIds = $exFunds->pluck('agencyID');
        $agencies = Agency::whereIn('id', $agencyIds)->get();
    
        return view('research.generatereports.allresearchmonitorings', [
            'researches' => $researches,
            'assignedRoles' => $assignedRoles,
            'exFunds' => $exFunds,
            'agencies' => $agencies,
            'columns' => $this->columns,
        ]);
    }
    
}
