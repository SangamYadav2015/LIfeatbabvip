<?php

namespace App\Repositories;

use App\Models\Settings;
use Illuminate\Support\Facades\File;

class SettingRepository
{
    protected $model;

    public function __construct(Settings $setting)
    {
        $this->model = $setting;
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
        $sectionStyle = Settings::findOrFail($id);
        $sectionStyle->delete();
        return $sectionStyle;
    }
}
