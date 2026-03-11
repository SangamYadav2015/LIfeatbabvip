<?php

namespace App\Services;

use App\Repositories\PageRepository;

class PageService
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }


    public function list()
    {
        return $this->pageRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->pageRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->pageRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->pageRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->pageRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->pageRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->pageRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
