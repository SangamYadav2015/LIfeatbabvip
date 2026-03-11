<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Support\Facades\File;

class DepartmentRepository
{
    protected $model;

    public function __construct(Department $userRole)
    {
        $this->model = $userRole;
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
   
   
    public function delete($id)
    {
        $page = Department::findOrFail($id);
        $page->delete();
        return $page;
    }
}
