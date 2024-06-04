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
    protected $reportTypes;
    protected $startDate;
    protected $endDate;
    protected $limit;
    protected $columns;
    protected $minPercentage;
    protected $maxPercentage;

    public function __construct($reportTypes, $startDate, $endDate, $limit, $columns, $minPercentage, $maxPercentage)
    {
        $this->reportTypes = $reportTypes;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->limit = $limit;
        $this->columns = $columns;
        $this->minPercentage = $minPercentage;
        $this->maxPercentage = $maxPercentage;
    }

    public function view() : View
    {
        $query = Research::query();
    
        if (!in_array('all', $this->reportTypes)) {
            $query->whereIn('status', $this->reportTypes);
        }
    
        if ($this->startDate) {
            $query->whereDate('startDate', '>=', $this->startDate);
        }
    
        if ($this->endDate) {
            $query->whereDate('endDate', '<=', $this->endDate);
        }
    
        if ($this->minPercentage !== null && $this->maxPercentage !== null) {
            $researchIdsWithMonitorings = Monitorings::whereBetween('progress', [$this->minPercentage, $this->maxPercentage])
                ->pluck('researchID')
                ->toArray();
        
            $researchIdsWithoutMonitorings = Research::whereNotIn('id', $researchIdsWithMonitorings)
                ->pluck('id')
                ->toArray();
        
            $researchIds = array_merge($researchIdsWithMonitorings, $researchIdsWithoutMonitorings);
        
            $query->whereIn('id', $researchIds);
        }       
        
        // if ($this->minPercentage !== null && $this->maxPercentage !== null) {
        //     $researchIds = Monitorings::whereBetween('progress', [$this->minPercentage, $this->maxPercentage])
        //         ->pluck('researchID');
            
        //     $query->whereIn('id', $researchIds);
        // }
    
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
    
        return view('editor.views.generatereports.allresearchmonitorings', [
            'researches' => $researches,
            'assignedRoles' => $assignedRoles,
            'exFunds' => $exFunds,
            'agencies' => $agencies,
            'columns' => $this->columns,
        ]);
    }
}
