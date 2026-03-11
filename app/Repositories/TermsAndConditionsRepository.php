<?php

namespace App\Repositories;

use App\Models\TermsAndConditions;

class TermsAndConditionsRepository
{
    protected $model;

    public function __construct(TermsAndConditions $termsAndConditions)
    {
        $this->model = $termsAndConditions;
    }

    // Return all terms and conditions
    public function list()
    {
        return $this->model; // Retrieve all terms and conditions
    }

    // Find a single term by its ID
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Create a new term with the provided attributes
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    // Update an existing term by ID with the provided attributes
    public function update(array $attributes, $id)
    {
        $term = $this->model->findOrFail($id);
        $term->update($attributes);
        return $term;
    }

    // Delete a term by its ID
    public function delete($id)
    {
        $term = $this->model->findOrFail($id);
        $term->delete();
        return $term;
    }
}
