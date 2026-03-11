<?php
namespace App\Services;

use App\Repositories\JobApplicationRepository;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\PostJob;
use App\Repositories\ApplicantRepository;


class JobApplicationService
{
    protected $jobApplicationRepository;
    protected $applicantRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepository ,ApplicantRepository $applicantRepository)
    {
        $this->jobApplicationRepository = $jobApplicationRepository;

        $this->applicantRepository = $applicantRepository;
    }
    public function applyForJob($jobId)
    {
        $applicantId = Auth::guard('applicant')->id(); // Get the currently authenticated applicant's ID
    
        // Check if the applicant has already applied for the specific job
        
    
        // Fetch the job to get the title
        $job = PostJob::find($jobId); // Make sure this model is properly imported
        if (!$job) {
            throw new Exception('Job not found.');
        }
    
        // Prepare data for storing
        $data = [
            'applicant_id' => $applicantId,
            'job_id' => $jobId,
            'title' => $job->title // Retrieve the job title from the Job model
        ];
    
        // Store the application using the repository
        return $this->jobApplicationRepository->create($data);
    }

    public function getAllVerifiedApplicants()
    {
        return $this->jobApplicationRepository->getAllVerifiedApplicants();
    }


   

  public function getJobApplicationStatus($applicantId, $jobId)
{
    // Get the applicant
    $applicant = $this->applicantRepository->findApplicantById($applicantId);

    // Get the job application associated with the jobId
    $jobApplication = $applicant->jobApplications->where('job_id', $jobId)->first();
    
    if (!$jobApplication) {
        return null; // Job application not found
    }

    // Get the status from the job application table
    $status = $jobApplication->status;
    $progress = $this->getProgressBasedOnStatus($status);

    return compact('jobApplication', 'progress', 'applicant', 'status');
}

private function getProgressBasedOnStatus($status)
{
    switch ($status) {
        case 'applied':
            return 10;
        case 'to_be_screened':
            return 30;
        case 'screened':
            return 50;
        case 'Shortlisted':
            return 60;
        case 'Interview schedule':
            return 70;
        case 'Background verification':
            return 85;
        case 'hired':
            return 100;
        case 'rejected':
            return 0;
        default:
            return 0;
    }
}

}

    

