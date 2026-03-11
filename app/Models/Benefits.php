<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Add this import for HasFactory


class Benefits extends Model
{

    use HasFactory;

    // Optionally, specify the table name if it doesn't follow the convention
    protected $table = 'benefits';
    
    protected $fillable = [
        'applicant_id',
        'annualgrosscompensation',
        'fixedSalary',
        'variablePay',
        'otherbenefits',
        'nextrevisiondate',
    ];

     // Optionally, define the fields that should be cast to specific data types
     protected $casts = [
        'nextrevisiondate' => 'date',  // Cast to a date if it's stored as a string or datetime
    ];

    // Define the relationship to the Applicant model (optional)
    

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id'); // 'applicant_id' is the foreign key
    }
}
