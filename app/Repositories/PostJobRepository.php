<?php

namespace App\Repositories;

use App\Models\PostJob;

class PostJobRepository
{
    protected $model;

    public function __construct(PostJob $postJob)
    {
        $this->model = $postJob;
    }

   
public function list()
{
    return $this->model->orderBy('id', 'desc');
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
        $item = $this->model->findOrFail($id);
        $item->delete();
        return $item;
    }
}
