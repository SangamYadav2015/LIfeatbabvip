<?php 
namespace App\Repositories;

interface ApplicantRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function findById($id);
    public function delete($id);
    public function findByEmail($email);
    public function setupTwoFactorAuth($applicantId);
    public function disableTwoFactorAuth($applicantId, $token);
    public function verifyAndEnableTwoFactorAuth($applicantId, $token);
    public function createauth(array $attributes);
}
