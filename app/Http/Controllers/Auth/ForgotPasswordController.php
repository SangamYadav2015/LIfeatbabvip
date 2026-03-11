<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\CustomResetPasswordEmail;
use App\Mail\ApplicantCustomResetPasswordEmail;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;


class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        try {
            return view('auth.forgot-password');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $email = $request->email;

            $user = User::where('email', $email)->first();

            if (!$user) {
                return Redirect::back()->withErrors(['email' => 'No user found with this email address.']);
            }

            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => now()]
            );

            $name = $user->name;
            $email = $user->email;

            Mail::to($email)->send(new CustomResetPasswordEmail($token, $name, $email));

            return Redirect::back()->with('success', 'Password reset Link has been sent your register email!');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
     public function showLinkRequestFormApplicant()
    {
        try {
            return view('auth.applicant-forgot-password');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    
    
    public function sendResetLinkEmailApplicant(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $email = $request->email;

            $user = Applicant::where('email', $email)->first();

            if (!$user) {
                return Redirect::back()->withErrors(['email' => 'No user found with this email address.']);
            }

            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'created_at' => now()]
            );

            $name = $user->name;
            $email = $user->email;

            Mail::to($email)->send(new ApplicantCustomResetPasswordEmail($token, $name, $email));

            return Redirect::back()->with('success', 'Password reset Link has been sent your register email!');
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
}
