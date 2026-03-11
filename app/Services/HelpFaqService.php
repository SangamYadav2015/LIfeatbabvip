<?php

namespace App\Services;

use App\Repositories\HelpFaqRepository;

class HelpFaqService
{
    protected $helpFaqRepository;

    public function __construct(HelpFaqRepository $helpFaqRepository)
    {
        $this->helpFaqRepository = $helpFaqRepository;
    }


    public function list()
    {
        return $this->helpFaqRepository->list();
    }


    public function create(array $data)
    {
        return $this->helpFaqRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->helpFaqRepository->update($data, $id);
    }

    
    public function singleDataFindId($id)
    {
        return $this->helpFaqRepository->find($id);
    }
    


    public function updateSectionStyle($id,$data)
    {
        return $this->helpFaqRepository->update($data, $id);
    }    

    public function delete($id)
    {
        return $this->helpFaqRepository->delete($id);

    }
}
