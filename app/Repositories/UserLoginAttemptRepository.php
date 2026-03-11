<?php

namespace App\Repositories;

use App\Models\UserLoginAttempt;
use Illuminate\Support\Facades\File;

class UserLoginAttemptRepository
{
    protected $model;

    public function __construct(UserLoginAttempt $userLoginAttempt)
    {
        $this->model = $userLoginAttempt;
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
   
    public function updateAttemptStatus(array $attributes, $id)
    {
        $record = $this->model->where('user_id', $id)->update($attributes);
        return $record;
    }

   
    public function delete($id)
    {
        $page = UserLoginAttempt::findOrFail($id);
        $page->delete();
        return $page;
    }
}
