<?php

namespace App\Repositories;

use App\Models\CareerSetting;

class CareerSettingRepository
{
    protected $model;

    // Constructor to inject the CareerSetting model
    public function __construct(CareerSetting $careerSetting)
    {
        $this->model = $careerSetting;
    }

    // Method to list all career settings
    public function list()
    {
        return $this->model;
    }

    // Method to create a new career setting
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Method to find a career setting by ID
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Method to update a career setting
    public function update(array $data, $id)
    {
        $careerSetting = $this->model->find($id);
        if ($careerSetting) {
            $careerSetting->update($data);
            return $careerSetting;
        }
        return null;
    }

    // Method to delete a career setting
    public function delete($id)
    {
        $careerSetting = $this->model->find($id);
        if ($careerSetting) {
            $careerSetting->delete();
            return $careerSetting;
        }
        return null;
    }
}
