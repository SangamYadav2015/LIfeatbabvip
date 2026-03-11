<?php

namespace App\Services;

use App\Repositories\SubscriberRepository;

class SubscriberService
{
    protected $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }


    public function list()
    {
        return $this->subscriberRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->subscriberRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->subscriberRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->subscriberRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->subscriberRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->subscriberRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->subscriberRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }

    public function toggleStatus($id)
{
    return $this->subscriberRepository->toggleStatus($id);
}
    
}
