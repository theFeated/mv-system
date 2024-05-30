<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Research;
use App\Models\ResearchTeam;
use App\Models\Monitorings;
use App\Models\ExternalFunds;
use App\Models\Agency;

class MonitoringsDataExport implements FromView
{
    private $research;
    private $assignedRole;
    private $monitorings;
    private $exFunds;
    private $agency;

    public function __construct($id)
    {
        $this->research = Research::find($id);
        $this->assignedRole = ResearchTeam::where('researchID', $id)->get();
        $this->monitorings = Monitorings::where('researchID', $id)->get();
        $this->exFunds = ExternalFunds::where('researchID', $id)->get();
        $agencyIDs = $this->exFunds->pluck('agencyID');
        $this->agency = Agency::whereIn('id', $agencyIDs)->get();
    }

    public function view() : View
    {
        return view('research.generatereports.monitoringsreport',[
            'research' => $this->research,
            'assignedRole' => $this->assignedRole,
            'monitorings'  => $this->monitorings,
            'exFunds' => $this->exFunds,
            'agency' => $this->agency,        
        ]);
    }
}