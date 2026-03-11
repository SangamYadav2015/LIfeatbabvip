<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{
    use HasFactory;

    protected $table = 'help_categories';

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

    public function helpFaq()
    {
        return $this->hasMany(HelpFaq::class, 'category_id');
    }
}
