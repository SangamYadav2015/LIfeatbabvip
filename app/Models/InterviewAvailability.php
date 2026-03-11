<?php

// app/Models/InterviewAvailability.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'name', 'email', 'available_from', 'available_to', 'availability_date'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

