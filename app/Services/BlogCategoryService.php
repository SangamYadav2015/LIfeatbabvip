<?php

namespace App\Services;

use App\Repositories\BlogCategoryRepository;

class BlogCategoryService
{
    protected $BlogCategoryRepository;

    public function __construct(BlogCategoryRepository $BlogCategoryRepository)
    {
        $this->BlogCategoryRepository = $BlogCategoryRepository;
    }


    public function list()
    {
        return $this->BlogCategoryRepository->list();
    }


    public function create(array $data)
    {
        return $this->BlogCategoryRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->BlogCategoryRepository->update($data, $id);
    }

    public function checkmenuNameExistence($name)
    {
        return $this->BlogCategoryRepository->sectionStyleNameCheck($name);
    }

    
    public function singleDataFindId($id)
    {
        return $this->BlogCategoryRepository->find($id);
    }
     

    public function delete($id)
    {
        return $this->BlogCategoryRepository->delete($id);

    }
}
