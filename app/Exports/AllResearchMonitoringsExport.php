<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Research;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;
use App\Models\Agency;

class AllResearchMonitoringsExport implements FromView
{
    public function view() : View
    {
        $researches = Research::all();
        $researchIds = $researches->pluck('id');
        $assignedRoles = ResearchTeam::whereIn('researchID', $researchIds)->get();
        $monitorings = Monitorings::whereIn('researchID', $researchIds)->get();
        $exFunds = ExternalFunds::whereIn('researchID', $researchIds)->get();
        $agencyIds = $exFunds->pluck('agencyID');
        $agency = Agency::whereIn('id', $agencyIds)->get();

        return view('research.generatereports.allresearchmonitorings', [
            'researches' => $researches,
            'assignedRoles' => $assignedRoles,
            'monitorings' => $monitorings,
            'exFunds' => $exFunds,
            'agency' => $agency,
        ]);
    }
}