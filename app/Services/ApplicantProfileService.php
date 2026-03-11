<?php
namespace App\Services;

use App\Repositories\ApplicantProfileRepository;
use Illuminate\Support\Facades\Storage;

class ApplicantProfileService
{
    protected $repo;

    public function __construct(ApplicantProfileRepository $repo)
    {
        $this->repo = $repo;
    }

    public function updatePersonalInfo($applicantId, array $data)
    {
        return $this->repo->updateOrCreatePersonalInfo($applicantId, $data);
    }

    public function updateEducationInfo($applicantId, array $data)
    {
        return $this->repo->updateOrCreateEducationInfo($applicantId, $data);
    }

    public function updateWorkInfo($applicantId, array $data)
    {
        if (isset($data['skills']) && is_array($data['skills'])) {
            $data['skills'] = implode(',', $data['skills']);
        }

        return $this->repo->updateOrCreateWorkInfo($applicantId, $data);
    }

    public function updateDocuments($applicantId, array $files)
    {
        $data = [];

            foreach (['Resume', 'aadhar_card_front', 'aadhar_card_back', 'pan_card', 'passport_file', 'passport_size_photographs'] as $field) {
        if (isset($files[$field]) && $files[$field] instanceof \Illuminate\Http\UploadedFile) {
            $data[$field] = $files[$field]->store('documents');
        }
    }

        
         // Handle passport Yes/No field
    if (isset($files['passport'])) {
        $data['passport'] = $files['passport']; // Store Yes or No
    }

        return $this->repo->updateOrCreateDocuments($applicantId, $data);
    }
}
