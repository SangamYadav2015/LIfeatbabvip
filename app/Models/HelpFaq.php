<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpFaq extends Model
{
    use HasFactory;

    protected $table = 'help_faq';

    protected $fillable = [
        'slug',
        'category_id',
        'question',
        'answer',
        'status',
    ];


    public static function validateRules($id = null)
    {
        $rules= [
            'category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ];
        return $rules;
    }

    public static function validateMessages()
    {
        return [
            'category_id.required' => 'Please select  category.',
            'question.required' => 'Please Enter Question.',
            'answer.required' => 'Please Enter Answer.',
            'status.required' => 'The status is required.',
        ];
    }
    
    public function helpCategory()
    {
        return $this->belongsTo(HelpCategory::class, 'category_id', 'id');
    }
}
