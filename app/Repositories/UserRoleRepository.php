<?php

namespace App\Repositories;

use App\Models\UserRole;
use Illuminate\Support\Facades\File;

class UserRoleRepository
{
    protected $model;

    public function __construct(UserRole $userRole)
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
        $page = UserRole::findOrFail($id);
        $page->delete();
        return $page;
    }
}
