<?php

namespace App\Services;

use App\Repositories\TeamRepository;

class TeamService
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }


    public function list()
    {
        return $this->teamRepository->list();
    }


    public function create(array $data)
    {
        return $this->teamRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->teamRepository->update($data, $id);
    }

    

    
   
    public function delete($id)
    {
        return $this->teamRepository->delete($id);

    }
}
