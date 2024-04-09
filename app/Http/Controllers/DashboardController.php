<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Research;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalResearch = Research::count();
        
        $researchPerYear = Research::select('year', DB::raw('COUNT(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('year')
            ->get();
    
        return view('dashboard', compact('totalResearch', 'researchPerYear'));
    }
    
}
