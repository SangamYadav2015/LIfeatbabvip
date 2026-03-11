<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotApplicant
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('applicant')->check()) {
            return redirect('/applicant/login'); // Redirect to applicant login if not authenticated
        }

        return $next($request);
    }
}
