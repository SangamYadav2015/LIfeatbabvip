<?php

namespace App\Services;

use App\Repositories\MenuRepository;

class MenuService
{
    protected $MenuRepository;

    public function __construct(MenuRepository $MenuRepository)
    {
        $this->MenuRepository = $MenuRepository;
    }


    public function list()
    {
        return $this->MenuRepository->list();
    }


    public function create(array $data)
    {
        return $this->MenuRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->MenuRepository->update($data, $id);
    }

    public function checkmenuNameExistence($name)
    {
        return $this->MenuRepository->sectionStyleNameCheck($name);
    }

    
    public function singleDataFindId($id)
    {
        return $this->MenuRepository->find($id);
    }
    


    public function updateSectionStyle($id,$data)
    {
        return $this->MenuRepository->update($data, $id);
    }    

    public function delete($id)
    {
        return $this->MenuRepository->delete($id);

    }
}
