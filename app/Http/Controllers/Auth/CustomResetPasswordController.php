<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Applicant;
use Exception;
use Illuminate\Support\Facades\Log;

class CustomResetPasswordController extends Controller
{


    public function showResetForm($token)
    {
        try {
            $expiration = 15;
            $tokenData = DB::table('password_reset_tokens')
                ->where('token', $token)
                ->first();
            if (!$tokenData || now()->subMinutes($expiration)->greaterThan($tokenData->created_at)) {
                return view('auth.token-expire', ['token' => $token]);
            }
            return view('auth.reset', ['token' => $token]);
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }



    public function reset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $token = $request->input('token');
            $email = $request->input('email');
            $password = $request->input('password');

            $tokenData = DB::table('password_reset_tokens')->where('email', $email)->where('token', $token)->first();

            if (!$tokenData) {
                return back()->withErrors(['email' => 'Invalid token or email.']);
            }

            $tokenExpiry = now()->subMinutes(15);
            if ($tokenData->created_at < $tokenExpiry) {
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                return back()->withErrors(['email' => 'Token has expired.']);
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'User not found.']);
            }

            $user->password = Hash::make($password);
            $user->save();

            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return redirect()->route('admin.login')->with('success', 'Password has been reset!');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function showResetFormApplicant($token)
    {
        try {
            $expiration = 15;
            $tokenData = DB::table('password_reset_tokens')
                ->where('token', $token)
                ->first();
            if (!$tokenData || now()->subMinutes($expiration)->greaterThan($tokenData->created_at)) {
                return view('auth.applicant-token-expire', ['token' => $token]);
            }
            return view('auth.applicant-reset', ['token' => $token]);
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function applicantreset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $token = $request->input('token');
            $email = $request->input('email');
            $password = $request->input('password');

            $tokenData = DB::table('password_reset_tokens')->where('email', $email)->where('token', $token)->first();

            if (!$tokenData) {
                return back()->withErrors(['email' => 'Invalid token or email.']);
            }

            $tokenExpiry = now()->subMinutes(15);
            if ($tokenData->created_at < $tokenExpiry) {
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                return back()->withErrors(['email' => 'Token has expired.']);
            }

            $user = Applicant::where('email', $email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'User not found.']);
            }

            $user->password = Hash::make($password);
            $user->save();

            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return redirect()->route('applicant.login')->with('success', 'Password has been reset!');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
}
