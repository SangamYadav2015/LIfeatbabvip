<?php 
namespace App\Repositories;

use App\Models\PersonalInformation;
use App\Models\EducationInformation;
use App\Models\WorkExperience;
use App\Models\Document;
use App\Models\Benefits;
use App\Models\Applicant;


class VerificationRepository
{
    public function savePersonalInformation($data)
    {
        return PersonalInformation::create($data);
    }

    public function saveEducationInformation($data)
    {
        return EducationInformation::create($data);
    }

    public function saveWorkExperience($data)
    {
        return WorkExperience::create($data);
    }

    public function saveBenefits($data)
    {
        return Benefits::create($data);
    }

   public function saveDocuments($data)
{
    // Process any file arrays (e.g., 'experience_letters', 'last_three_salary_slip') before saving
    if (isset($data['experience_letters']) && is_array($data['experience_letters'])) {
        // Process the array of files and then convert it to JSON format
        $data['experience_letters'] = json_encode($this->processFileArray($data['experience_letters'], 'documents/experience_letters'));
    }
    
    if (isset($data['last_three_salary_slip']) && is_array($data['last_three_salary_slip'])) {
        // Process the array of files and then convert it to JSON format
        $data['last_three_salary_slip'] = json_encode($this->processFileArray($data['last_three_salary_slip'], 'documents/salary_slips'));
    }
    
    // Handle individual files for marksheets, certificates, and other documents
    $documentFields = [
        'tenth_class_marksheet' => 'documents/marksheets',
        'twelfth_class_marksheet' => 'documents/marksheets',
        'graduation_marksheet' => 'documents/marksheets',
        'post_graduation_marksheet' => 'documents/marksheets',
        'blood_group_certificate' => 'documents/certificates',
        'passport_size_photographs' => 'documents/photos',
        'aadhar_card' => 'documents/id_cards',
        'voter_id_card' => 'documents/id_cards',
        'pan_card' => 'documents/id_cards',
        'covid_vaccine_certificate' => 'documents/certificates',
        'bank_account_details' => 'documents/banking',
        'relieving_letter' => 'documents/letters',
        'resignation_letter' => 'documents/letters'
    ];

    // Loop through the fields and process the files
    foreach ($documentFields as $field => $path) {
        if (isset($data[$field]) && $data[$field]->isValid()) {
            $data[$field] = $this->processFile($data[$field], $path);
        }
    }

    // Now save the data in the Document model
    return Document::create($data);
}

protected function processFile($file, $path)
{
    // Store the file and return its path
    if ($file->isValid()) {
        return $file->store($path, 'public');  // Store in 'public/storage' folder
    }

    throw new \Exception("Invalid file upload.");
}

protected function processFileArray($files, $path)
{
    $filePaths = [];

    foreach ($files as $file) {
        if ($file->isValid()) {
            // Process each file and store the path
            $filePaths[] = $this->processFile($file, $path);
        }
    }

    // Return an array of file paths
    return $filePaths;
}

    
   

    public function getApplicantData($applicantId)
    {
        // Fetch the applicant with related data
        $applicant = Applicant::with([
            'applicant',
            'educationInformation',
            'workExperience',
            'benefits',
            'documents',
            'faqResponses.faq'
        ])->find($applicantId);

        return $applicant;
    }
}
