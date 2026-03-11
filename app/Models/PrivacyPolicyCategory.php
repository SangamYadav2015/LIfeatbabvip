<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicyCategory extends Model
{
    use HasFactory;

    protected $table = 'privacy_policy_categories';

    protected $fillable = [
        'category_name',
        'status',
    ];

    public static function validateRules()
    {
        return [
            'category_name' => 'required|exists:help_category,category_name',
            'status' => 'required',
        ];
    }

    public static function validateMessages()
    {
        return [
            'category_name' => 'Please Enter  Category Name.',
            'category_name.exists' => 'The category name already used.',
            'status.required' => 'The status is required.',
        ];
    }

    public function privacyPolicies()
    {
        return $this->hasMany(PrivacyPolicy::class, 'category_id');
    }
}
