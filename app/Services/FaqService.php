<?php

namespace App\Services;

use App\Repositories\FaqRepository;

class FaqService
{
    protected $faqRepo;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepo = $faqRepo;
    }

    public function getAllFaqs()
    {
        return $this->faqRepo->all();
    }

    public function storeFaq($data)
    {
        return $this->faqRepo->store($data);
    }
    
    public function update(array $data, $id)
    {
        return $this->faqRepo->update($data, $id);
    }
    public function findFaq($id)
    {
        return $this->faqRepo->find($id);
    }

    public function updateFaq(array $data, $id)
    {
        return $this->faqRepo->update($data, $id);
    }

    public function deleteFaq($id)
    {
        return $this->faqRepo->deleteFaq($id);
    }
}
