<?php 
namespace App\Services;

interface ApplicantServiceInterface
{
    public function register(array $data);
    public function updateProfile($id, array $data);
    public function deleteProfile($id);
    public function changePassword($id, $newPassword);
    public function setupTwoFactorAuth($applicantId);
    public function disableTwoFactorAuth($applicantId, $token);
    public function verifyAndEnableTwoFactorAuth($applicantId, $token);
    public function createFromSignedUrl(array $data);
}
