<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository
{
    protected $model;
    
    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }
    
    public function all()
    {
        return $this->model->latest();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
    
    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }
    
    
    public function findFaq($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateFaq(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }

    public function deleteFaq($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}
