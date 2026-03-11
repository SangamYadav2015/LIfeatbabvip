<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'question',
        'status',
    ];

    public static function validateRules(): array
    {
        return [
            'question' => 'required|string|max:255',
            
        ];
    }

    public static function validateMessages(): array
    {
        return [
            'question.required' => 'The question field is required.',
           
        ];
    }
    // Relationship: One FAQ has many responses
  public function faqResponses()
{
    return $this->hasMany(FaqResponse::class, 'faq_id');
}


    
}
