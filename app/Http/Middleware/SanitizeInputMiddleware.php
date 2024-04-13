<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class SanitizeInputMiddleware
{
    public function handle($request, Closure $next)
    {
        $errorMessage = "Your access has been blocked due to security concerns.";
        $blockDuration = 10; // Block duration in seconds
        $input = $request->all();
        
        // Check for SQL injection attacks or XSS attacks
        if ($this->containsSQLInjection($input) || $this->containsXSS($input)) {
            Auth::logout();
            Session::invalidate();
            
            Cache::put('blocked_user_' . $request->ip(), true, now()->addSeconds($blockDuration));
    
            return response()->view('errors.blocked', ['message' => $errorMessage, 'blockDuration' => $blockDuration], 403)
                ->header('z-index', '9999')
                ->header('position', 'fixed');
        }
        
        return $next($request);
    }
    
    protected function containsSQLInjection($input)
    {
        // Define an array of patterns representing SQL injection attempts
        $patterns = [
            '/\b\d+\b/', // Matches any numeric value (including years)
            '/\b\d+[<>]=?\d+\b/', // Matches numeric comparisons (e.g., 1>0, 2-1, 0+1)
            '/\b\d+[\/*%&]+(\d+|\(.+?\)|\d+[<>]=?\d+|\btrue\b)\b/i', // Matches arithmetic operations and logical AND/OR operations (e.g., 1*1, 1&&2, -1 || 1)
        ];
    
        foreach ($input as $value) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $value)) {
                    return true; // SQL injection detected
                }
            }
        }
    
        return false;
    }
    
    protected function containsXSS($input)
    {
        // Define an array of patterns representing XSS attempts
        $patterns = [
            '/<\s*img[^>]*src\s*=\s*["\'][^"\']*["\'][^>]*>/i', // Matches <img> tags with src attribute
            '/<\s*script[^>]*>.*?<\s*\/\s*script\s*>/i', // Matches <script> tags and their contents
            '/<\s*style[^>]*>.*?<\s*\/\s*style\s*>/i', // Matches <style> tags and their contents
            '/<\s*iframe[^>]*>.*?<\s*\/\s*iframe\s*>/i', // Matches <iframe> tags and their contents
            '/<\s*object[^>]*>.*?<\s*\/\s*object\s*>/i', // Matches <object> tags and their contents
            '/<\s*embed[^>]*>.*?<\s*\/\s*embed\s*>/i', // Matches <embed> tags and their contents
            '/<\s*frame[^>]*>.*?<\s*\/\s*frame\s*>/i', // Matches <frame> tags and their contents
            '/<\s*form[^>]*>.*?<\s*\/\s*form\s*>/i', // Matches <form> tags and their contents
            '/<\s*a[^>]*href\s*=\s*["\'][^"\']*["\'][^>]*>/i', // Matches <a> tags with href attribute
            '/<\s*input[^>]*value\s*=\s*["\'][^"\']*["\'][^>]*>/i', // Matches <input> tags with value attribute
            '/<\s*div[^>]*>.*?<\s*\/\s*div\s*>/i', // Matches <div> tags and their contents
            '/<\s*span[^>]*>.*?<\s*\/\s*span\s*>/i', // Matches <span> tags and their contents
            '/<\s*table[^>]*>.*?<\s*\/\s*table\s*>/i', // Matches <table> tags and their contents
        ];
    
        foreach ($input as $value) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $value)) {
                    return true; // XSS attempt detected
                }
            }
        }
    
        return false;
    }
    

    protected function blockUser($ip, $duration)
    {
        Cache::put('blocked_user_' . $ip, true, now()->addSeconds($duration));
    }
}
