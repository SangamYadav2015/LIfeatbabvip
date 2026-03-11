<?php

namespace App\Services;

use App\Repositories\PrivacyPolicyRepository;

class PrivacyPolicyService
{
    protected $privacyPolicyRepository;

    public function __construct(PrivacyPolicyRepository $privacyPolicyRepository)
    {
        $this->privacyPolicyRepository = $privacyPolicyRepository;
    }


    public function list()
    {
        return $this->privacyPolicyRepository->list();
    }


    public function create(array $data)
    {
        return $this->privacyPolicyRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->privacyPolicyRepository->update($data, $id);
    }

    
    public function singleDataFindId($id)
    {
        return $this->privacyPolicyRepository->find($id);
    }
    


    public function updateSectionStyle($id,$data)
    {
        return $this->privacyPolicyRepository->update($data, $id);
    }    

    public function delete($id)
    {
        return $this->privacyPolicyRepository->delete($id);

    }
}
