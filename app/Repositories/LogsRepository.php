<?php

namespace App\Repositories;

use App\Models\Log;
use Illuminate\Support\Facades\File;

class LogsRepository
{
    protected $model;

    public function __construct(Log $log)
    {
        $this->model = $log;
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

    public function update($attributes, $id)
    {
        $record = Log::where('id',$id)->update($attributes);
        return $record;
    }
   
   
    public function delete($id)
    {
        $log = Log::findOrFail($id);
        $log->delete();
        return $log;
    }
}
