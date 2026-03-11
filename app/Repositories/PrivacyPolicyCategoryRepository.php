<?php

namespace App\Repositories;

use App\Models\PrivacyPolicyCategory;
use App\Models\HelpFaq;
use Illuminate\Support\Facades\File;

class PrivacyPolicyCategoryRepository
{
    protected $model;

    public function __construct(PrivacyPolicyCategory $privacyPolicyCategory)
    {
        $this->model = $privacyPolicyCategory;
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
        $page = PrivacyPolicyCategory::findOrFail($id);
        $page->delete();
        // $pageSection = HelpFaq::where('category_id', $id)->delete();
        return $page;
    }
}
