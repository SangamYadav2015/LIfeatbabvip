<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // $token = $request->header('Authorization') ?? $request->server('HTTP_AUTHORIZATION');

        // if (!$token || !str_starts_with($token, 'Bearer ')) {
        //     return response()->json(['error' => 'Unauthorized: Token required'], 401);
        // }

        // // Trim spaces and remove unexpected characters
        // $token = trim(substr($token, 7), "\"");

        // if ($token !== env('API_SECRET_TOKEN')) {
        //     return response()->json(['error' => 'Unauthorized: Invalid token'], 401);
        // }

        return $next($request);
    }
}
