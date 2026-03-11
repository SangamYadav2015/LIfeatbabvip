<?php

namespace App\Services;

use App\Repositories\LogsRepository;

class LogsServices
{
    protected $logsRepository;

    public function __construct(LogsRepository $logsRepository)
    {
        $this->logsRepository = $logsRepository;
    }


    public function list()
    {
        return $this->logsRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->logsRepository->create($sectionData);
    }
    public function update($data, $id)
    {
        return $this->logsRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->logsRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->logsRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->logsRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->logsRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
