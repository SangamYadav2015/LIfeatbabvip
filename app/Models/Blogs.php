<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'blog_category',
        'blog_title',
        'blog_slug',
        'blog_image1',
        'image1_alt',
        'blog_image2',
        'image2_alt',
        'blog_image3',
        'image3_alt',
        'blog_short_details1',
        'blog_short_details2',
        'blog_details1',
        'blog_details2',
        'created_by',
        'status',
    ];

    public static function validateRules($id = null)
    {
        $rules= [
            'blog_category' => 'required',
            'blog_title' => 'required',
            'blog_short_details' => 'required',
            'status' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['blog_image'] = 'required|image|mimes:jpg,jpeg,png,gif,svg|dimensions:width=650,height=400';

        }
        return $rules;
    }

    public static function validateMessages()
    {
        return [
            'blog_category.required' => 'Please select blog category.',
            'blog_title.required' => 'Please Enter Blog Title.',
            'blog_short_details.required' => 'The short description is required.',
            'status.required' => 'The status is required.',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Blogcategory::class, 'blog_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
