<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function save(Request $request)
    {
        $user = auth()->user();
    
        // Update profile fields
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
    
        // Check if a new password is provided and validate old password if so
        if ($request->filled('password')) {
            if (!Hash::check($request->input('old_password'), $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect');
            }
            $user->password = Hash::make($request->input('password'));
        }
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'img_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    
    
}
