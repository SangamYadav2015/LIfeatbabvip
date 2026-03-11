<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'Resume',
        'aadhar_card_front',
        'aadhar_card_back',
        
        'passport_size_photographs',
        
        'pan_card',
       
        'applicant_id',   // Add this line
        'passport',
        'passport_file'
    ];

    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformation::class, 'applicant_id');
    }

    public function postJob()
    {
        return $this->belongsTo(PostJob::class);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id'); // 'applicant_id' is the foreign key
    }
}
