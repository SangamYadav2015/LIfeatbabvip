<?php

namespace App\Services;

use App\Repositories\ContactEnqueryRepository;

class ContactEnqueryService
{
    protected $contactEnqueryRepository;

    public function __construct(ContactEnqueryRepository $contactEnqueryRepository)
    {
        $this->contactEnqueryRepository = $contactEnqueryRepository;
    }


    public function list()
    {
        return $this->contactEnqueryRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->contactEnqueryRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->contactEnqueryRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->contactEnqueryRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->contactEnqueryRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->contactEnqueryRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->contactEnqueryRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }

 
    
}
