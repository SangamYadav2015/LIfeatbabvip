<?php

namespace App\Repositories;

use App\Models\JobApplication;



class JobApplicationRepository
{
    public function create(array $data)
    {
        return JobApplication::create($data);
    }
   
   public function getAllVerifiedApplicants()
{
    return JobApplication::with(['applicant:id,first_name', 'job:id,title'])
        ->whereNotNull('applicant_id')
        ->get()
        ->map(function ($application) {

            if (!$application->applicant) {
                return null;
            }

            return [
                'job_application_id' => $application->id,
                'applicant_id'       => $application->applicant_id,
                'first_name'         => $application->applicant->first_name ?? '',
                'title'              => $application->job->title ?? 'N/A',
                'status'             => $application->status ?? 'pending',
                'progress'           => $application->progress ?? 0,
            ];
        })
        ->filter()
        ->values();
}



   
}
