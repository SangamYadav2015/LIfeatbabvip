<?php

namespace App\Services;

use App\Repositories\CareerSettingRepository;

class CareerSettingService
{
    protected $careerSettingRepository;

    // Constructor to inject the repository
    public function __construct(CareerSettingRepository $careerSettingRepository)
    {
        $this->careerSettingRepository = $careerSettingRepository;
    }

    // Method to list all career settings
    public function list()
    {
        return $this->careerSettingRepository->list();
    }

    // Method to create a new career setting
    public function create(array $data)
    {
        return $this->careerSettingRepository->create($data);
    }

    // Method to update a career setting
    public function update(array $data, $id)
    {
        return $this->careerSettingRepository->update($data, $id);
    }

    // Method to find a career setting by ID
    public function singleDataFindId($id)
    {
        return $this->careerSettingRepository->find($id);
    }

    // Method to delete a career setting
    public function delete($id)
    {
        return $this->careerSettingRepository->delete($id);
    }
}
