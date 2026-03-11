<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ApplicantDetails extends Model
{
    use HasFactory;

    protected $table = 'applicant_details';

    // Define fillable fields
    protected $fillable = [
        'applicant_id',
        'job_id', 
        'full_name',
        'age',
        'address',
        'phone',
        'email',
        'city',
        'state',
        'zip',
        'country',
        'job_title',
        'salary_desired',
        'available_start_date',
        'highest_education',
        'institution_name',
        'degree_earned',
        'graduation_year',
        'most_recent_job_title',
        'most_recent_company_name',
        'most_recent_employment_dates',
        'most_recent_responsibilities',
        'previous_job_title',
        'previous_company_name',
        'previous_employment_dates',
        'previous_responsibilities',
        'skills',
        'certifications',
        'resume',
        'cover_letter',
    ];

    // Define validation rules
    public static function rules($applicantId = null)
    {
        return [
            'full_name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:1',
            'phone' => 'nullable|string|max:15',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('applicant_details')->ignore($applicantId), // Ignore existing email when updating
            ],
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'job_title' => 'nullable|string|max:255',
            'salary_desired' => 'nullable|numeric',
            'available_start_date' => 'nullable|date',
            'highest_education' => 'nullable|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'degree_earned' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1900|max:' . date('Y'), // Example for graduation year range
            'most_recent_job_title' => 'nullable|string|max:255',
            'most_recent_company_name' => 'nullable|string|max:255',
            'most_recent_employment_dates' => 'nullable|string|max:255',
            'most_recent_responsibilities' => 'nullable|string|max:500',
            'previous_job_title' => 'nullable|string|max:255',
            'previous_company_name' => 'nullable|string|max:255',
            'previous_employment_dates' => 'nullable|string|max:255',
            'previous_responsibilities' => 'nullable|string|max:500',
            'skills' => 'nullable|string|max:500',
            'certifications' => 'nullable|string|max:500',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Example for file validation
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Example for file validation
        ];
    }
}
