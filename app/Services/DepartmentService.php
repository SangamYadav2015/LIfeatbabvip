<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }


    public function list()
    {
        return $this->departmentRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->departmentRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->departmentRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->departmentRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->departmentRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->departmentRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->departmentRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
