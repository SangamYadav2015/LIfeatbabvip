<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferLetter extends Model
{
    use HasFactory;
    protected $fillable = ['applicant_id', 'file_path'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
