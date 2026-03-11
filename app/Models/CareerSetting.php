<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSetting extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's default naming convention
    protected $table = 'career_settings';

    // Define the fields that are mass assignable
    protected $fillable = [
        'title',
        'subtitle',
        'name',
        'designation',
        'icon_image',
        'logo',
        'base_heading',
        'base_icon', // assuming base_icon is an array or JSON field
        'right_heading',
        'right_sub_heading',
        'status',
    ];

    // If base_icon is stored as an array or JSON, you might want to cast it
    protected $casts = [
        'base_icon' => 'array',  // Ensure base_icon is cast to an array
    ];

    // You can also define any relationships or custom methods if needed
}
