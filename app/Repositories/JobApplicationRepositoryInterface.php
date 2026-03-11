<?php

namespace App\Repositories;

interface JobApplicationRepositoryInterface
{
    public function find($id);
    public function create(array $data);
    public function exists($jobId, $applicantId);
    public function getJobApplications($applicantId);
}
