<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AutoLogoutMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            $now = Carbon::now();
            $logoutTime = config('session.lifetime') * 60; // Convert minutes to seconds

            if ($lastActivity && $now->diffInSeconds($lastActivity) >= $logoutTime) {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is inactive. Please contact admin support.',
                ]);
            }

            session(['lastActivityTime' => $now]);
        }

        return $next($request);
    }
}
