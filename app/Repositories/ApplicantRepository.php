<?php

namespace App\Repositories;

use App\Models\Applicant;
use App\Models\Notification;
use App\Models\InterviewAvailability;
use PragmaRX\Google2FAQRCode\Google2FA;

class ApplicantRepository
{
    protected $model;

    public function __construct(Applicant $applicant)
    {
        $this->model = $applicant;
    }

    public function list()
    {
        return $this->model;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $applicant = $this->find($id);
        $applicant->update($attributes);
        return $applicant;
    }

    public function delete($id)
    {
        $applicant = $this->find($id);
        return $applicant->delete();
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function createProfileImage(array $data)
    {
        if (isset($data['profile_image'])) {
            $imagePath = $this->handleImageUpload($data['profile_image']);
            $data['profile_image'] = $imagePath;

            return $this->model->create([
                'profile_image' => $data['profile_image']
            ]);
        }

        return null;
    }

    public function updateProfileImage($id, array $data)
    {
        $applicant = $this->find($id);

        if (isset($data['profile_image'])) {
            $imagePath = $this->handleImageUpload($data['profile_image']);
            $applicant->update(['profile_image' => $imagePath]);
        }

        return $applicant;
    }

    private function handleImageUpload($image)
    {
        return $image->store('profile_images', 'public');
    }

    public function getAllApplicantsWithJobApplicationsCount()
    {
        return $this->model->withCount('jobApplications')->paginate(10);
    }


    public function findNotificationById($id)
    {
        return Notification::findOrFail($id);
    }

    public function updateOfferAcceptedStatus($notification, $status)
    {
        $notification->offer_accepted = $status;
        $notification->save();
    }

   
    
    public function findApplicantById($id)
    {
        return $this->model->findOrFail($id);
    }
    
    public function getTotalApplicants()
    {
        return $this->model->count();
    }
    public function getJobApplicationsWithPostJob($applicantId)
    {
        return \App\Models\JobApplication::with('postJob')
            ->where('applicant_id', $applicantId)
            ->get();
    }
    
    public function setupTwoFactorAuth($applicantId)
    {
        $user = $this->find($applicantId); // Uses existing `find()` method
        $QR_Image = '';
        $secret = $user->google2fa_secret;
    
        if (is_null($user->google2fa_secret) || $user->google2fa_enabled == false) {
            $google2fa = new Google2FA();
            $secret = $google2fa->generateSecretKey();
            $user->google2fa_secret = $secret;
            $user->save();
    
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $secret
            );
        }
    
        return [
            'QR_Image' => $QR_Image,
            'secret' => $secret
        ];
    }
    
    public function disableTwoFactorAuth($applicantId, $token)
    {
        $user = $this->find($applicantId);
        $google2fa = new Google2FA();
        $window = 4;
    
        if ($google2fa->verifyKey($user->google2fa_secret, $token, $window)) {
            $user->google2fa_enabled = false;
            $user->google2fa_secret = null;
            $user->save();
            return true;
        }
    
        return false;
    }
    
    public function verifyAndEnableTwoFactorAuth($applicantId, $token)
    {
        $user = $this->find($applicantId);
        $google2fa = new Google2FA();
        $window = 2;
    
        if ($google2fa->verifyKey($user->google2fa_secret, $token, $window)) {
            $user->google2fa_enabled = true;
            $user->save();
            return true;
        }
    
        return false;
    }
    
  public function createauth(array $attributes)
    {
        return $this->model::createauth($attributes);
    }
}
