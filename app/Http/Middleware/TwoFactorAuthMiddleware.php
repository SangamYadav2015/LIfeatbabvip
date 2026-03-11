<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->google2fa_enabled && !$request->session()->get('2fa_passed')) {
            return redirect()->route('admin.verifytwostep');
        }
        return $next($request);
    }
}