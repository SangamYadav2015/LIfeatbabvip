<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\Section;
use Illuminate\Support\Facades\File;

class TeamRepository
{
    protected $model;

    public function __construct(Team $team)
    {
        $this->model = $team;
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
        $item = Team::findOrFail($id);
        $item->delete();
        return $item;
    }
}
