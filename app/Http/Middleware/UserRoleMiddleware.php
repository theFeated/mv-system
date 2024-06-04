<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }
    
        $errorMessage = "You don't have permission to access this page";
        return response()->view('messages.403', ['message' => $errorMessage], 403)
                         ->header('Refresh', '5;url=' . url()->previous());
    }
    
}
