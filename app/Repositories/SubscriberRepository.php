<?php

namespace App\Repositories;

use App\Models\Subscriber;
use Illuminate\Support\Facades\File;

class SubscriberRepository
{
    protected $model;

    public function __construct(Subscriber $subscriber)
    {
        $this->model = $subscriber;
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
        $page = Subscriber::findOrFail($id);
        $page->delete();
        return $page;
    }

    public function toggleStatus($id)
{
    $subscriber = $this->model->findOrFail($id);
    $subscriber->status = !$subscriber->status;
    $subscriber->save();
    return $subscriber;
}
}
