<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Section;
use App\Models\Page;

use Illuminate\Support\Facades\File;

class MenuRepository
{
    protected $model;

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
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
    public function sectionStyleNameCheck($menuName)
    {
        return Menu::where('title', $menuName)
            ->exists();
    }

  

    public function delete($id)
    {
        $item = Menu::findOrFail($id);
        $item->delete();
        $itemPage = Page::where('menu_id', $id)->delete();

        return $item;
    }
}
