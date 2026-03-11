<?php

namespace App\Services;

use App\Repositories\PostJobRepository;

class PostJobService
{
    protected $postJobRepository;

    public function __construct(PostJobRepository $postJobRepository)
    {
        $this->postJobRepository = $postJobRepository;
    }

   
    public function list()
    {
        return $this->postJobRepository->list();
    }

   
    public function create(array $data)
    {

        if (!isset($data['salary_disclosed']) || !$data['salary_disclosed']) {
            // If salary is not disclosed, set salary fields to null
            $data['minimum_salary'] = null;
            $data['maximum_salary'] = null;
        } else {
            $data['salary_disclosed'] = 1;
        }
    
        return $this->postJobRepository->create($data);
    }

   
    public function update(array $data, $id)
    {
        return $this->postJobRepository->update($data, $id);
    }

    
   
    public function find($id)
    {
        return $this->postJobRepository->find($id); // Ensure your repository has this method
    }
    
   
    public function updateSectionStyle($id, array $data)
    {
        return $this->postJobRepository->update($data, $id);
    }

   
    public function delete($id)
    {
        return $this->postJobRepository->delete($id);
    }

    public function getTotalPostJobs()
{
    return $this->postJobRepository->list()->count();
}
   
}
