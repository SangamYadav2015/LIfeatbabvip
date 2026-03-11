<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Facades\File;

class PageRepository
{
    protected $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
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
        $page = Page::findOrFail($id);
        $page->delete();
        $pageSection = PageSection::where('page_id', $id)->delete();
        return $page;
    }
}
