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
    
        $researches = Research::when($year, function ($query) use ($year) {
            $query->whereYear('startDate', $year);
        })->get();

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

        $data = [
            [
                'title' => 'Total Researches',
                'value' => $researches->count(),
                'icon_class' => 'fas fa-project-diagram',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total Internal Funded Researches',
                'value' => $researches->where('isInternalFund', 1)->count(),
                'icon_class' => 'fas fa-money-bill',
                'border_color' => 'border-left-success',
            ],
            [
                'title' => 'Total External Funded Researches',
                'value' => $researches->where('isInternalFund', 0)->count(),
                'icon_class' => 'fas fa-money-bill',
                'border_color' => 'border-left-info',
            ],
            [
                'title' => 'Total Agencies',
                'value' => $totalAgencies,
                'icon_class' => 'fas fa-building',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total Colleges',
                'value' => $totalColleges,
                'icon_class' => 'fas fa-university',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total External Funds',
                'value' => $totalExternalFunds,
                'icon_class' => 'fas fa-hand-holding-usd',
                'border_color' => 'border-left-primary',
            ],
            [
                'title' => 'Total Budget',
                'value' => $totalBudget,
                'icon_class' => 'fas fa-coins',
                'border_color' => 'border-left-success',
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
                'border_color' => 'border-left-primary',
            ],            [
                'title' => 'Total Roles',
                'value' => $totalRoles,
                'icon_class' => 'fas fa-user-tag',
                'border_color' => 'border-left-primary',
            ],
            
        ];
        // foreach ($statusCountsbyMonitoring as $status => $count) {
        //     $data[] = [
        //         'title' => "Research with $status status via the monitorings",
        //         'value' => $count,
        //         'icon_class' => 'fas fa-chart-line', // You can change the icon based on status if needed
        //         'border_color' => 'border-left-primary',
        //     ];
        // }

        foreach ($collegeCounts as $collegeID => $count) {
            $college = College::find($collegeID);
            $data[] = [
                'title' => "Total Researchers in {$college->acronym}",
                'value' => $count,
                'icon_class' => 'fas fa-user-graduate', // You can change the icon if needed
                'border_color' => 'border-left-primary',
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
