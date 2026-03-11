<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Applicant;
use App\Services\ApplicantService;

class TwoStepAuthController extends Controller
{
    protected $applicantService;
    public function __construct(ApplicantService $applicantService)
    {
        $this->applicantService = $applicantService;
        $this->google2fa = app('pragmarx.google2fa');
    }
    
    
     public function enable2FA(Request $request)
    {
        try {
            $applicantID = auth()->guard('applicant')->user()->id;
    
            $data = $this->applicantService->setupTwoFactorAuth($applicantID);
    
            return view('applicant.google-2fa.enable', [
                'QR_Image' => $data['QR_Image'],
                'secret' => $data['secret']
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Enable Two Step Auth Failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            return response()->view('errors.500', [], 500);
        }
    }

    
    
    public function disable2FA(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
            ]);
    
            $applicantID = auth()->guard('applicant')->user()->id;
            $success = $this->applicantService->disableTwoFactorAuth($applicantID, $request->input('token'));
    
            if ($success) {
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
            $request->validate([
                'token' => 'required|string',
            ]);
    
            $applicantID = auth()->guard('applicant')->user()->id;
            $success = $this->applicantService->verifyAndEnableTwoFactorAuth($applicantID, $request->input('token'));
    
            if ($success) {
                return redirect()->back()->with('success', 'Two-Factor Authentication enabled successfully.');
            } else {
                return back()->withErrors(['token' => 'Invalid token, please try again.']);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('verify two step failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

}
