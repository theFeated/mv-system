<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Research;
use App\Models\Agency;
use App\Models\College;
use App\Models\ExternalFunds;
use App\Models\Monitorings;
use App\Models\Researcher;
use App\Models\Roles;

use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function dashboard(Request $request)
    {
        $year = $request->input('year');
    
        // Using cursor() for lazy loading
        $researches = Research::when($year, function ($query) use ($year) {
            $query->whereYear('startDate', $year);
        })->cursor();
    
        $totalResearches = 0;
        $totalInternalFundedResearches = 0;
        $totalExternalFundedResearches = 0;
    
        foreach ($researches as $research) {
            $totalResearches++;
            if ($research->isInternalFund) {
                $totalInternalFundedResearches++;
            } else {
                $totalExternalFundedResearches++;
            }
        }
    
        $totalAgencies = Agency::count();
        $totalColleges = College::count();
        $totalExternalFunds = ExternalFunds::count();
        $totalBudget = ExternalFunds::sum('total_budget');
        $totalBudgetUtilized = ExternalFunds::sum('budget_utilized');
        $monitorings = Monitorings::all();
        $statusCountsbyMonitoring = $monitorings->groupBy('status')->map->count();
        $totalResearchers = Researcher::count();
        $researchers = Researcher::all();
        $collegeCounts = $researchers->groupBy('collegeID')->map->count();
        $totalRoles = Roles::count();
    
        $statusCountsByResearch = Research::groupBy('status')
            ->select('status', DB::raw('count(*) as total'))
            ->pluck('total', 'status');
            
        $monitoringCount = $monitorings->count();

        $data = [
            [
                'title' => 'Total Researches',
                'value' => $totalResearches,
                'icon_class' => 'fas fa-project-diagram',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total Internal Funded Researches',
                'value' => $totalInternalFundedResearches,
                'icon_class' => 'fas fa-money-bill',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total External Funded Researches',
                'value' => $totalExternalFundedResearches,
                'icon_class' => 'fas fa-money-bill',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total Agencies',
                'value' => $totalAgencies,
                'icon_class' => 'fas fa-building',
                'border_color' => 'border-left-success',
            ],
            [
                'title' => 'Total Colleges',
                'value' => $totalColleges,
                'icon_class' => 'fas fa-university',
                'border_color' => 'border-left-success',
            ],
            [
                'title' => 'Total External Funds',
                'value' => $totalExternalFunds,
                'icon_class' => 'fas fa-hand-holding-usd',
                'border_color' => 'border-left-success',
            ],
            [
                'title' => 'Total Budget',
                'value' => $totalBudget,
                'icon_class' => 'fas fa-coins',
                'border_color' => 'border-left-info',
            ],
            [
                'title' => 'Total Budget Utilized',
                'value' => $totalBudgetUtilized,
                'icon_class' => 'fas fa-money-bill-wave',
                'border_color' => 'border-left-info',
            ],
            [
                'title' => 'Total Researchers',
                'value' => $totalResearchers,
                'icon_class' => 'fas fa-user-graduate',
                'border_color' => 'border-left-warning',
            ],
            [
                'title' => 'Total Roles',
                'value' => $totalRoles,
                'icon_class' => 'fas fa-user-tag',
                'border_color' => 'border-left-warning',
            ],
            [
                'title' => 'Total Monitorings',
                'value' => $monitoringCount,
                'icon_class' => 'fas fa-chart-bar',
                'border_color' => 'border-left-info',
            ],
        ];
    
        foreach ($collegeCounts as $collegeID => $count) {
            $college = College::find($collegeID);
            $data[] = [
                'title' => "Total Researchers in {$college->acronym}",
                'value' => $count,
                'icon_class' => 'fas fa-user-graduate',
                'border_color' => 'border-left-warning',
            ];
        }
    
        foreach ($statusCountsByResearch as $status => $count) {
            $data[] = [
                'title' => "Research with $status status",
                'value' => $count,
                'icon_class' => 'fas fa-chart-line',
                'border_color' => 'border-left-primary',
            ];
        }
    
        return view('dashboard', compact('data'));
    }
    
}
