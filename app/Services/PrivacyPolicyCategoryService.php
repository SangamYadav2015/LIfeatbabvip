<?php

namespace App\Services;

use App\Repositories\PrivacyPolicyCategoryRepository;

class privacyPolicyCategoryService
{
    protected $privacyPolicyCategoryRepository;

    public function __construct(PrivacyPolicyCategoryRepository $privacyPolicyCategoryRepository)
    {
        $this->privacyPolicyCategoryRepository = $privacyPolicyCategoryRepository;
    }


    public function list()
    {
        return $this->privacyPolicyCategoryRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->privacyPolicyCategoryRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->privacyPolicyCategoryRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->privacyPolicyCategoryRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->privacyPolicyCategoryRepository->delete($id);

    }

}
