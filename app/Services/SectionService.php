<?php

namespace App\Services;

use App\Repositories\SectionRepository;

class SectionService
{
    protected $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }


    public function sectionList()
    {
        return $this->sectionRepository->list();
    }


    public function createUser(array $sectionData)
    {
        return $this->sectionRepository->create($sectionData);
    }
    public function update(array $sectionData, $id)
    {
        return $this->sectionRepository->update($sectionData, $id);
    }

   
}
