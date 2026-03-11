<?php

namespace App\Repositories;

use App\Models\ContactEnquery;
use Illuminate\Support\Facades\File;

class ContactEnqueryRepository
{
    protected $model;

    public function __construct(ContactEnquery $contactEnquery)
    {
        $this->model = $contactEnquery;
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
        $record = $this->model->findOrFail($id);
        $record->delete();
        return $record;
    }
}
