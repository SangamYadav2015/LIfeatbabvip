<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobApplicationService;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;
use App\Services\VerificationService;

class JobApplicationController extends Controller
{
    protected $jobApplicationService;
    protected $verificationService;


    public function __construct(JobApplicationService $jobApplicationService, VerificationService $verificationService)
    {
        $this->jobApplicationService = $jobApplicationService;
        $this->verificationService = $verificationService;
    }

    public function apply(Request $request)
{
    // Apply for the job
    try {
    // Check if the applicant is authenticated
    if (!Auth::guard('applicant')->check()) {
        return redirect()->route('applicant.login')->with('error', 'You need to be logged in to apply for a job.');
    }
    $jobId =$request->job_id;
    // Get the applicant ID
    $applicantId = Auth::guard('applicant')->id();

    // Fetch applicant data using the service function
    $applicant = $this->verificationService->getApplicantData($applicantId);

     // Check if the applicant has already applied for the job
     $alreadyApplied = \App\Models\JobApplication::where('applicant_id', $applicantId)
     ->where('job_id', $jobId)
     ->exists();

if ($alreadyApplied) {
// If already applied, redirect to the applicant's profile page
return redirect()->route('applicant.dashboard')
->with('info', 'You have already applied for this job. Please check your application status.');
}else{
    $this->jobApplicationService->applyForJob($jobId);

}


    // Check if the applicant's profile is complete
    $profileIncomplete = 
    !$applicant || 
    !$applicant->personalInformation || 
    !$applicant->educationInformation || 
    !$applicant->workExperience || 
    !$applicant->benefits || 
    !$applicant->documents || 
    !isset($applicant->personalInformation->full_name) || 
    empty($applicant->personalInformation->full_name); // Add specific checks for other fields if needed

if ($profileIncomplete) {
    // Redirect to the verification form if the profile is incomplete
    return redirect()->route('applicant.profile', $applicantId)
        ->with('info', 'Please complete your profile before applying for a job.');
}


   
    return redirect()->route('applicant.dashboard',)
    ->with('success', 'Job application submitted successfully. View Job Status and complete your profile');

    
        
        // Redirect to profile with success message
    } catch (\Exception $e) {
        // Handle error and redirect back with the error message
        return redirect()->back()->with('error', $e->getMessage());
    }
}





/**
 * Determine the next verification step based on the missing profile data.
 */
private function getNextVerificationStep($applicant)
{
    // Check for missing information and return the corresponding step
    if (!$applicant->personalInformation) {
        return 1; // Personal information step
    } elseif (!$applicant->educationInformation) {
        return 2; // Education information step
    } elseif (!$applicant->workExperience) {
        return 3; // Work experience step
    } elseif (!$applicant->benefits) {
        return 4; // Benefits step
    } elseif (!$applicant->documents) {
        return 5; // Documents step
    }

    // Default to step 1 if no data is missing
    return 1;
}

    

   
}
