<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
    'middle_name',
    'last_name',
    'date_of_birth',
    'phone',
    'email',
    'house_no',
    'landmark',
    'area',
    'current_address',
    'permanent_address',
    'city',
    'state',
    'zip',
    'country',
    'gender',
    'job_id',
    'applicant_id',
       
    ];

    public function education()
    {
        return $this->hasone(EducationInformation::class,'applicant_id', 'applicant_id');
    }

    

    public function workExperience()
    {
        return $this->hasone(WorkExperience::class,'applicant_id', 'applicant_id');
    }

    public function document()
    {
        return $this->hasOne(Document::class, 'applicant_id');
    }

    public function benefit()
    {
        return $this->hasOne(Benefits::class, 'applicant_id');
    }

    
    public function job()
    {
        return $this->belongsTo(PostJob::class, 'job_id'); // 'job_id' is the foreign key column in 'personal_informations' table
    }

    // Relationship with Applicant (many-to-one)
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'applicant_id'); // The foreign key might need to be 'applicant_id' or another key based on your schema
    }
   
}
