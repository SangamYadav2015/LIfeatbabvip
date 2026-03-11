<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use Exception;
use Illuminate\Support\Facades\Log;


class TwoStepAuthController extends Controller
{
public function __construct()
{
    $this->google2fa = app('pragmarx.google2fa');
}
    public function enable2FA(Request $request)
    {
        try {
            $user = $request->user();
            $secret = $user->google2fa_secret;
            $QR_Image = '';
            if ($user->google2fa_secret == null || $user->google2fa_enabled == false) {
                $google2fa = new Google2FA();
                $secret = $google2fa->generateSecretKey();
                $user->google2fa_secret = $secret;
                $user->save();
                $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $user->email,
                    $secret
                );
                return view('admin.google-2fa.enable', [
                    'QR_Image' => $QR_Image,
                    'secret' => $secret
                ]);
            }
            return view('admin.google-2fa.enable', [
                'QR_Image' => $QR_Image,
                'secret' => $secret
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('enable two step  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function disable2FA(Request $request)
    {
        try {
            $user = $request->user();
            $google2fa = new Google2FA();
            $request->validate([
                'token' => 'required|string',
            ]);

            $window = 4; 
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('token'), $window);

            if ($valid) {
                $user->google2fa_enabled = false;
                $user->google2fa_secret = null;
                $user->save();
                return redirect()->back()->with('success', 'Two-Factor Authentication disabled successfully.');
            } else {
                return back()->withErrors(['token' => 'Invalid token, please try again.']);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('disable two step retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function verify2FA(Request $request)
    {
        try {
            $user = $request->user();
            $google2fa = new Google2FA();
            $request->validate([
                'token' => 'required|string',
            ]);
            $window = 2; 
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('token'), $window);

            if ($valid) {
                $user->google2fa_enabled = true;
                $user->save();
                return redirect()->back()->with('success', 'Two-Factor Authentication enabled successfully.');
            } else {
                return back()->withErrors(['token' => 'Invalid token, please try again.']);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('verify two step  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
