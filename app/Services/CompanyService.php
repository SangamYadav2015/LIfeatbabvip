<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    
    public function list()
    {
        return $this->companyRepository->list();
    }

    
    public function create(array $companyData)
    {
        return $this->companyRepository->create($companyData);
    }

   
    public function update(array $data, $id)
    {
        return $this->companyRepository->update($data, $id);
    }

    
    public function delete($id)
    {
        return $this->companyRepository->delete($id);
    }

    
   

   
}
