<?php

namespace App\Services;

use App\Repositories\BlogRepository;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    public function list()
    {
        return $this->blogRepository->list();
    }


    public function create(array $data)
    {
        return $this->blogRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->blogRepository->update($data, $id);
    }

    public function checkmenuNameExistence($name)
    {
        return $this->blogRepository->sectionStyleNameCheck($name);
    }

    
    public function singleDataFindId($id)
    {
        return $this->blogRepository->find($id);
    }
    


    public function updateSectionStyle($id,$data)
    {
        return $this->blogRepository->update($data, $id);
    }    

    public function delete($id)
    {
        return $this->blogRepository->delete($id);

    }
}
