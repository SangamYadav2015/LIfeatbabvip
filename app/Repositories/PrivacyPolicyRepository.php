<?php

namespace App\Repositories;

use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\File;

class PrivacyPolicyRepository
{
    protected $model;

    public function __construct(PrivacyPolicy $privacyPolicy)
    {
        $this->model = $privacyPolicy;
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
        $item = PrivacyPolicy::findOrFail($id);
        $item->delete();
        return $item;
    }
}
