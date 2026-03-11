<?php

namespace App\Services;

use App\Repositories\MaintinanceEnqueryRepository;

class MaintinanceEnqueryService
{
    protected $maintinanceEnqueryRepository;

    public function __construct(MaintinanceEnqueryRepository $maintinanceEnqueryRepository)
    {
        $this->maintinanceEnqueryRepository = $maintinanceEnqueryRepository;
    }


    public function list()
    {
        return $this->maintinanceEnqueryRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->maintinanceEnqueryRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->maintinanceEnqueryRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->maintinanceEnqueryRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->maintinanceEnqueryRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->maintinanceEnqueryRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->maintinanceEnqueryRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
