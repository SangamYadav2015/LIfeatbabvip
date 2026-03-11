<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $table = 'privacy_policy';

    protected $fillable = [
        'category_id',
        'description',
        'status',
    ];


    public static function validateRules($id = null)
    {
        $rules= [
            'category_id' => 'required',
            'description' => 'required',
            'status' => 'required',
        ];
        return $rules;
    }

    public static function validateMessages()
    {
        return [
            'category_id.required' => 'Please select  category.',
            'description.required' => 'Please Enter Description.',
            'status.required' => 'The status is required.',
        ];
    }
    
    // Relationship to category
    public function category()
    {
        return $this->belongsTo(PrivacyPolicyCategory::class, 'category_id');
    }
}
