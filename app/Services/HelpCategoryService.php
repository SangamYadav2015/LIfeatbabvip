<?php

namespace App\Services;

use App\Repositories\HelpCategoryRepository;

class HelpCategoryService
{
    protected $helpCategoryRepository;

    public function __construct(HelpCategoryRepository $helpCategoryRepository)
    {
        $this->helpCategoryRepository = $helpCategoryRepository;
    }


    public function list()
    {
        return $this->helpCategoryRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->helpCategoryRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->helpCategoryRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->helpCategoryRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->helpCategoryRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->helpCategoryRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->helpCategoryRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
