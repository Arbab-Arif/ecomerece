<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is not authenticated
        if (!Auth::check()) {
            // Redirect to login page
            return redirect()->route('admin.login')->with('error', 'Please login to access this page.');
        }

        // Allow the request to proceed if authenticated
        return $next($request);
    }
}
