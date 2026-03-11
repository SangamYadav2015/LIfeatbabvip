<?php

namespace App\Repositories;

use App\Models\InterviewAvailability;

class InterviewAvailabilityRepository
{
    protected $model;

    public function __construct(InterviewAvailability $model)
    {
        $this->model = $model;
    }

  public function getCurrentMonthAvailability($perPage = 10)
{
    return $this->model->newQuery()
        ->select('interview_availabilities.*')
        ->whereMonth('availability_date', now()->month)
        ->whereYear('availability_date', now()->year)
        ->whereRaw('NOT EXISTS (
            SELECT 1 FROM interview_availabilities ia2
            WHERE ia2.availability_date = interview_availabilities.availability_date
              AND ia2.available_from = interview_availabilities.available_from
              AND ia2.email != interview_availabilities.email
              AND MONTH(ia2.availability_date) = MONTH(CURDATE())
              AND YEAR(ia2.availability_date) = YEAR(CURDATE())
        )')
        ->orderBy('availability_date', 'desc')
        ->paginate($perPage);
}

    
    public function storeAvailability($applicantId, array $data)
{
    $exists = $this->model->where('availability_date', $data['availability_date'])
        ->where('available_from', $data['available_from'])
        ->where('available_to', $data['available_to'])
        ->exists();

    if ($exists) return false;

    return $this->model->create([
        'applicant_id' => $applicantId,
        'availability_date' => $data['availability_date'],
        'available_from' => $data['available_from'],
        'available_to' => $data['available_to'],
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
}

}
