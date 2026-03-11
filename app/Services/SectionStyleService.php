<?php

namespace App\Services;

use App\Repositories\SectionStyleRepository;

class SectionStyleService
{
    protected $sectionstyleRepository;

    public function __construct(SectionStyleRepository $sectionstyleRepository)
    {
        $this->sectionstyleRepository = $sectionstyleRepository;
    }


    public function sectionStyleList()
    {
        return $this->sectionstyleRepository->list();
    }


    public function createSectionStyle(array $sectionData)
    {
        return $this->sectionstyleRepository->create($sectionData);
    }
    public function update(array $sectionData, $id)
    {
        return $this->sectionstyleRepository->update($sectionData, $id);
    }

    public function checkSectionStyleNameExistence($sectionStyleName, $sectionId)
    {
        return $this->sectionstyleRepository->sectionStyleNameCheck($sectionStyleName, $sectionId);
    }

    
    public function singleDataFindId($id)
    {
        return $this->sectionstyleRepository->find($id);
    }
    

    public function createFormFile($data)
    {
        return $this->sectionstyleRepository->storeCreateFileblade($data);
    }

    public function updateSectionStyle($id,$data)
    {
        return $this->sectionstyleRepository->update($data, $id);
    }    

    public function deleteSectionStyle($id)
    {
        return $this->sectionstyleRepository->delete($id);

    }
}
