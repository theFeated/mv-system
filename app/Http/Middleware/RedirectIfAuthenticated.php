<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $blockMessage = "You're currently blocked from accessing this page. Please try again later.";
    
        $isBlocked = Cache::get('login_blocked_' . $request->ip(), false);
    
        if ($isBlocked) {
            return response()->view('errors.blocked', ['message' => $blockMessage], 403)->header('z-index', '9999')->header('position', 'fixed');
        }
    
        if (Auth::guard($guard)->check()) {
            $errorMessage = "You've attempted to access the login page too many times. You have been logged out and cannot log in for the next hour.";
    
            $loginAttempts = Cache::get('login_attempts_' . $request->ip(), 0);
            $loginAttempts++;
    
            Cache::put('login_attempts_' . $request->ip(), $loginAttempts, now()->addHour());
    
            if ($loginAttempts >= 3) {
                Auth::logout();
                Session::invalidate();
                $blockDuration = 30; // Seconds
                Cache::put('login_blocked_' . $request->ip(), true, now()->addSeconds($blockDuration));
                return response()->view('errors.blocked', ['message' => $errorMessage, 'blockDuration' => $blockDuration], 403)->header('z-index', '9999')->header('position', 'fixed');
            }
    
            return redirect('/dashboard');
        }
    
        return $next($request);
    }
    
    
}
