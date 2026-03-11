<?php

namespace App\Repositories;

use App\Models\MaintinanceEnquery;
use Illuminate\Support\Facades\File;

class MaintinanceEnqueryRepository
{
    protected $model;

    public function __construct(MaintinanceEnquery $maintinanceEnquery)
    {
        $this->model = $maintinanceEnquery;
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
        $page = ContactEnquery::findOrFail($id);
        $page->delete();
        return $page;
    }
}
