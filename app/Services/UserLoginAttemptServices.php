<?php

namespace App\Services;

use App\Repositories\UserLoginAttemptRepository;

class UserLoginAttemptServices
{
    protected $userLoginAttemptRepository;

    public function __construct(UserLoginAttemptRepository $userLoginAttemptRepository)
    {
        $this->userLoginAttemptRepository = $userLoginAttemptRepository;
    }


    public function list()
    {
        return $this->userLoginAttemptRepository->list();
    }


    public function create(array $data)
    {
        return $this->userLoginAttemptRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->userLoginAttemptRepository->update($data, $id);
    }

    public function updateAttemptStatus(array $data, $id)
    {
        return $this->userLoginAttemptRepository->updateAttemptStatus($data, $id);
    }
    
    public function singleDataFindId($id)
    {
        return $this->userLoginAttemptRepository->find($id);
    }
   
    public function delete($id)
    {
        return $this->userLoginAttemptRepository->delete($id);

    }


    
}
