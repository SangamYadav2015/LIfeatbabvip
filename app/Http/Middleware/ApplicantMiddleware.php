<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('applicant')->check()) {
            return redirect()->route('applicant.login')->with('error', 'You must be logged in to apply for a job.');
        }
    
        return $next($request);
    }
}
