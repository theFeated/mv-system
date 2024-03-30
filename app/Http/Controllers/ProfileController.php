<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;


class ProfileController extends Controller
{

    public function save(Request $request)
    {
        $user = auth()->user();
    
        $user->name = $request->input('name');
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    
}