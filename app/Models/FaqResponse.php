<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqResponse extends Model
{
    use HasFactory;
     protected $fillable = [
        'faq_id',
        'applicant_id',
        'responses', // if you're using this field as an array in DB
    ];

protected $casts = [
    'responses' => 'array',
];
    public function faq()
{
    return $this->belongsTo(Faq::class);
}

public function applicant()
{
    return $this->belongsTo(Applicant::class);
}
}
