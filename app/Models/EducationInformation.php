<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_id',
        'highest_education',

        // 10th
        'tenth_passout_year',
        'tenth_school',
        'tenth_board_name',
        'tenth_percentage',

        // 12th
        'twelfth_passout_year',
        'twelfth_school',
        'twelfth_board_name',
        'twelfth_percentage',
        'twelfth_stream',

        // Diploma
        'has_diploma',
        'diploma_name',
        'diploma_specialization',
        'diploma_percentage',
        'diploma_institution',
        'diploma_passout_year',

        // Degree
        'has_degree',
        'degree_level',
        'degree_specialization',
        'degree_percentage',
        'degree_institution',
        'degree_passout_year',

        // Masters
        'masters_specialization',
        'masters_percentage',
        'masters_institution',
        'masters_passout_year',

        // Skills
        'skills_relevant',
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
