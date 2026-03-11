<?php

namespace App\Services;

use App\Repositories\LocationRepository;

class LocationService
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

   
    public function list()
    {
        return $this->locationRepository->list();
    }

    
    public function create(array $locationData)
    {
        return $this->locationRepository->create($locationData);
    }

    
    public function update(array $data, $id)
    {
        return $this->locationRepository->update($data, $id);
    }

    
    public function find($id)
    {
        return $this->locationRepository->find($id);
    }

    
    public function delete($id)
    {
        return $this->locationRepository->delete($id);
    }

    // Additional methods for specific operations can be added here
}
