<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    protected $model;

    public function __construct(Location $location)
    {
        $this->model = $location;
    }

    // Return the model query for chaining methods like paginate
    public function list()
    {
        return $this->model;
    }

    // Find a single location by its ID
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Create a new location with the provided attributes
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    // Update an existing location by ID with the provided attributes
    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }

    // Delete a location by its ID
    public function delete($id)
    {
        $location = $this->model->findOrFail($id);
        $location->delete();
        return $location;
    }
}
