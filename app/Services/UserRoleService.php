<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;

class UserRoleService
{
    protected $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }


    public function list()
    {
        return $this->userRoleRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->userRoleRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->userRoleRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->userRoleRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->userRoleRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->userRoleRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->userRoleRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
