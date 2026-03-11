<?php
namespace App\Repositories;

use App\Models\PersonalInformation;
use App\Models\EducationInformation;
use App\Models\WorkExperience;
use App\Models\Document;

class ApplicantProfileRepository
{
    public function updateOrCreatePersonalInfo($applicantId, array $data)
    {
        return PersonalInformation::updateOrCreate(
            ['applicant_id' => $applicantId],
            $data
        );
    }

    public function updateOrCreateEducationInfo($applicantId, array $data)
    {
        return EducationInformation::updateOrCreate(
            ['applicant_id' => $applicantId],
            $data
        );
    }

    public function updateOrCreateWorkInfo($applicantId, array $data)
    {
        return WorkExperience::updateOrCreate(
            ['applicant_id' => $applicantId],
            $data
        );
    }

    public function updateOrCreateDocuments($applicantId, array $data)
    {
        return Document::updateOrCreate(
            ['applicant_id' => $applicantId],
            $data
        );
    }
}
