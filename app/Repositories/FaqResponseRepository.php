<?php

namespace App\Repositories;

use App\Models\FaqResponse;

class FaqResponseRepository
{
    protected $model;
    
    public function __construct(FaqResponse $faqresponse)
    {
        $this->model = $faqresponse;
    }
    
    public function store($data)
    {
        return $this->model->create($data);
    }
}
