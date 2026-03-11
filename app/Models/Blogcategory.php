<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'blog_category';

    // Define the fillable fields
    protected $fillable = [
        'category_name',
        'category_slug',
        'status',
    ];

    
    public static function validateRules()
    {
        return [
            'category_name' => 'required|exists:blog_category,category_name',
            'status' => 'required',
        ];
    }

    public static function validateMessages()
    {
        return [
            'category_name' => 'Please select menu.',
            'category_name.exists' => 'The category name already used.',
            'status.required' => 'The status is required.',
        ];
    }


    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'blog_category');
    }
}
