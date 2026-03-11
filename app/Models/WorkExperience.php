<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    
     protected $casts = [
    'skills' => 'array',
];
    protected $fillable = [
    'applicant_id',
    'designation',
    'employment_type',
    'company_name',
    'current_working',
    'start_month',
    'start_year',
    'end_month',
    'end_year',
    'location',
    'salary_ctc',
    'skills',
    'position',
];

    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformation::class, 'applicant_id');
    }

    public function postJob()
    {
        return $this->belongsTo(PostJob::class);
    }
}
