<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Research;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    
}
