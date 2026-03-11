<?php

namespace App\Repositories;

use App\Models\Section;

class SectionRepository
{
    protected $model;

    public function __construct(Section $section)
    {
        $this->model = $section;
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
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id); 
        $record->update($attributes); 
        return $record;
    }

}
