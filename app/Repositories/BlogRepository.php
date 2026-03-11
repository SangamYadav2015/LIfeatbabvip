<?php

namespace App\Repositories;

use App\Models\Blogs;
use App\Models\Section;
use Illuminate\Support\Facades\File;

class BlogRepository
{
    protected $model;

    public function __construct(Blogs $blog)
    {
        $this->model = $blog;
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
        $item = Blogs::findOrFail($id);
        $item->delete();
        return $item;
    }
}
