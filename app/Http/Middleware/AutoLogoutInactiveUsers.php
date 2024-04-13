<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AutoLogoutInactiveUsers
{
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated
        if (Auth::guard($guard)->check()) {
            $inactivityTimeout = config('app.inactivity_timeout', 600);

            $lastActivity = Session::get('last_activity');

            // Check if last activity time is set and calculate the time difference
            if ($lastActivity && time() - $lastActivity > $inactivityTimeout) {
                Auth::guard($guard)->logout();
                Session::invalidate();
                $logoutMessage = "You've been logged out due to inactivity.";
                return redirect()->route('login')->with('logoutMessage', $logoutMessage);
            }
        }

        // Update last activity time
        Session::put('last_activity', time());

        return $next($request);
    }
}
