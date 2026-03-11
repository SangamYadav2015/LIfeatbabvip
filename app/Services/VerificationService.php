<?php 
namespace App\Services;

use App\Repositories\VerificationRepository;
use App\Models\PersonalInformation;   // Correct namespace
use App\Models\EducationInformation;  // Correct namespace
use App\Models\WorkExperience;        // Correct namespace
use App\Models\Document;              // Correct namespace


class VerificationService
{
    protected $verificationRepo;

    public function __construct(VerificationRepository $verificationRepo)
    {
        $this->verificationRepo = $verificationRepo;
    }

    public function handleVerificationStep($step, $data)
    {
        switch ($step) {
            case 1: // Personal Information
                return $this->handlePersonalInformation($data);

            case 2: // Education Information
                return $this->handleEducationInformation($data);

            case 3: // Work Experience
                return $this->handleWorkExperience($data);

            case 4: // Documents
                return $this->handleDocuments($data);

                case 5: // Documents
                    return $this->handleBenefits($data);

            default:
                throw new \Exception("Invalid verification step.");
        }
    }

    protected function handlePersonalInformation($data)
    {
        // Validate and format the data if necessary
        return $this->verificationRepo->savePersonalInformation($data);
    }

    protected function handleEducationInformation($data)
    {
        // Validate and format the data if necessary
        return $this->verificationRepo->saveEducationInformation($data);
    }

    protected function handleWorkExperience($data)
    {
        // Validate and format the data if necessary
        return $this->verificationRepo->saveWorkExperience($data);
    }

    protected function handleDocuments($data)
    {
        // Validate and format the data if necessary
        return $this->verificationRepo->saveDocuments($data);
    }

    protected function handleBenefits($data)
    {
        // Validate and format the data if necessary
        return $this->verificationRepo->saveBenefits($data);
    }

   
    public function getApplicantData($applicantId)
    {
        // Fetch the data from the repository
        return $this->verificationRepo->getApplicantData($applicantId);
    }


    
    
}
