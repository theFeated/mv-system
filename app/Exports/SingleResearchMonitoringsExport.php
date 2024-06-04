<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Research;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;
use App\Models\Agency;

class SingleResearchMonitoringsExport implements FromView
{
    private $research;

    public function __construct($id)
    {
        $this->research = Research::find($id);
    }

    public function view(): View
    {
        $assignedRole = ResearchTeam::where('researchID', $this->research->id)->get();
        $monitorings = Monitorings::where('researchID', $this->research->id)->get();
        $exFunds = ExternalFunds::where('researchID', $this->research->id)->get();
        $agencyIDs = $exFunds->pluck('agencyID');
        $agency = Agency::whereIn('id', $agencyIDs)->get();
    
        $researches = collect([$this->research]);
    
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
    
        return view('editor.views.generatereports.singleresearchmonitorings', [
            'researches' => $researches,
            'assignedRoles' => $assignedRoles,
            'exFunds' => $exFunds,
            'agencies' => $agencies,
            'columns' => ['Program/Project/Study Title', 'Project Duration based on Special Order', 'Reference', 'Project Team', 'Designation', 'Source of Funding', 'Total Budget', 'Budget Utilized', 'Percentage of Completion', 'Special Order', 'Collaborating College/Agency', 'Field of Study', 'Status', 'Year Completed', 'Remarks'],
        ]);
    }
}
