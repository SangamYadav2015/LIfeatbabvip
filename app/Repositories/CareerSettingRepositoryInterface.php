<?php

namespace App\Repositories;

use App\Models\CareerSetting;

interface CareerSettingRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
