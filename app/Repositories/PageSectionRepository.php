<?php

namespace App\Repositories;

use App\Models\PageSection;
use Illuminate\Support\Facades\File;

class PageSectionRepository
{
    protected $model;

    public function __construct(PageSection $pageSection)
    {
        $this->model = $pageSection;
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

    public function insert($attributes)
    {
        return $this->model->insert($attributes);
    }

    public function updateData($id, $attributes)
    {
        return $this->model->where('id',$id)->update($attributes);
    }


    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }
   
   
    public function delete($id)
    {
        $sectionStyle = PageSection::findOrFail($id);
        $sectionStyle->delete();
        return $sectionStyle;
    }
}
