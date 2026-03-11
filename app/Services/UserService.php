<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function list()
    {
        return $this->userRepository->list();
    }


    public function create(array $sectionData)
    {
        return $this->userRepository->create($sectionData);
    }
    public function update(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->userRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->userRepository->delete($id);

    }

    public function updateHomePage($id)
    {
        $allPages = $this->userRepository->list()->get();
        foreach ($allPages as $page) {
            $page->is_home = 0;
            $page->save();
        }
    
        // Find the specific page by ID and set is_home to '1'
        $page = $this->userRepository->find($id);
        if ($page) {
            $page->is_home = 1;
            $page->save();
        }
    }
    
}
