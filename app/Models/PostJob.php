<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'title',
        'job_slug',
        'description',
        'company_id',
        'department_id',
        'location_id', // This should match your database field
        'type',
        'designation',
       'minimum_salary',
        'maximum_salary',
        'status',
        
     
        
        'salary_disclosed',
    ];

    // Define validation rules
    public static function validateRules($id = null)
    {
        return [
            'title' => [
            'required',
            'string',
            'max:255',
            'regex:/^[A-Za-z\s]+$/'
        ],
            
            'description' => 'required|string',
            'location_id' => 'required|exists:locations,id', // Corrected to use location_id
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',
            'type' => 'required|string',
   'designation' => [
            'required',
            'string',
            'regex:/^[A-Za-z\s]+$/'
        ],            
        'salary_disclosed' => 'required|boolean',
            'minimum_salary' => 'nullable|numeric|min:0',
            'maximum_salary' => 'nullable|numeric|min:0|gte:minimum_salary',
            'status' => 'required|in:active,inactive,pending',
            
        ];
    }

    // Define validation messages
    public static function validateMessages()
    {
        return [
            'title.required' => 'Job title is required.',
            'description.required' => 'Job description is required.',
            'location_id.required' => 'Job location is required.',
            'company_id.required' => 'Company is required.',
            'company_id.exists' => 'The selected company does not exist.',
            'department_id.required' => 'Department is required.',
            'department_id.exists' => 'The selected department does not exist.',
            'type.required' => 'Job type is required.',
            'designation.required' => 'Designation is required.',

            'salary.numeric' => 'Salary must be a number.',
            'salary.min' => 'Salary must be at least 0.',
            'status.required' => 'Job status is required.',
            'status.in' => 'Invalid status selected.',
            'employment_type.required' => 'Employment type is required.',
            
        ];
    }

    protected $casts = [
        'posted_at' => 'datetime',
        'expire_at' => 'datetime',
    ];

    // Define relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id'); // Ensure 'location_id' matches your database schema
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    // Relationship with PersonalInformation (one-to-many)
    public function personalInformation()
    {
        return $this->hasMany(PersonalInformation::class, 'job_id');
    }

    public function applicants()
{
    return $this->hasMany(JobApplication::class, 'job_id');
}


}
