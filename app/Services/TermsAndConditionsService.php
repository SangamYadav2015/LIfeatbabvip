<?php 

namespace App\Services;

use App\Repositories\TermsAndConditionsRepository;

class TermsAndConditionsService
{
    protected $repository;

    public function __construct(TermsAndConditionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTerms()
    {
        return $this->repository->list();
    }

    public function getTermById($id)
    {
        return $this->repository->find($id);
    }

    public function createTerm(array $data)
    {
        return $this->repository->create($data); // Ensure this method exists in the repository
    }

    public function updateTerm(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function deleteTerm($id)
    {
        return $this->repository->delete($id);
    }
}
