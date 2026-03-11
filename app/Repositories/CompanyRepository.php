<?php
namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{

    protected $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }
    public function list()
    {
        return $this->model;
    }
   
    public function find($id)
    {
        return $this->model->find($id);
    }

   
    public function create(array $attributes)
    {
        return $this->model->create($attributes); // Create a new company with given attributes
    }

    
    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id); // Find the company by its ID or fail
        $record->update($attributes); // Update the company with new attributes
        return $record; // Return the updated company
    }

    
    public function delete($id)
    {
        $company = $this->model->findOrFail($id); // Find the company by its ID or fail
        $company->delete(); // Delete the company
        return $company; // Return the deleted company
    }

    
}
