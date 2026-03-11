<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;

class ApplicantMiddlewareAPI
{
    public function handle(Request $request, Closure $next)
    {
        // Extract the token from the Authorization header
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'status' => false,
                'message' => 'Authorization token not provided.',
            ], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        // Find the applicant by login_token or remember_token
        $applicant = Applicant::where('login_token', $token)
                              ->orWhere('remember_token', $token)
                              ->first();

        if (!$applicant) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token.',
            ], 401);
        }

        // Check if account is active
        if ($applicant->status !== 'active') {
            return response()->json([
                'status' => false,
                'message' => 'Your account is not active.',
            ], 403);
        }

        // Check if login_token is expired
        if ($applicant->login_token && $applicant->login_token_expires_at && now()->greaterThan($applicant->login_token_expires_at)) {
            return response()->json([
                'status' => false,
                'message' => 'Login token has expired. Please log in again.',
            ], 401);
        }

        // Set the authenticated user
        Auth::guard('applicant')->setUser($applicant);

        return $next($request);
    }
}
