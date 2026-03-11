<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }


    public function list()
    {
        return $this->settingRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->settingRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->settingRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->settingRepository->find($id);
    }
   
    public function deleteSectionStyle($id)
    {
        return $this->settingRepository->delete($id);

    }
}
