<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'location_name',
        'location_slug',
        'location_image',
        'short_description',
       
    ];

    // Validation rules for creating or updating a location
    public static function validateRules($id = null)
    {
        $rules = [
            'location_name' => 'required|string|max:255',
            'location_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string',
            'location_slug' => 'required|string|unique:locations,location_slug' . ($id ? ",$id" : ''),
           
        ];

        // If updating, location_image is not required unless a new image is being uploaded
        if (!is_null($id)) {
            $rules['location_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    // Custom validation messages
    public static function validateMessages()
    {
        return [
            'location_name.required' => 'Please enter the location name.',
            'location_name.string' => 'The location name must be a valid string.',
            'location_name.max' => 'The location name may not be greater than 255 characters.',
            'location_image.required' => 'Please upload an image for the location.',
            'location_image.image' => 'The uploaded file must be an image.',
            'location_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'location_image.max' => 'The image size may not exceed 2MB.',
            'short_description.string' => 'The short description must be a valid string.',
            'location_slug.required' => 'Please enter a unique slug for the location.',
            'location_slug.string' => 'The location slug must be a valid string.',
            'location_slug.unique' => 'The location slug has already been taken. Please choose another.',
           
        ];
    }

    // Relationship with User model (assuming User is the creator of the location)
   

    public function postJobs()
    {
        return $this->hasMany(PostJob::class, 'location_id'); // 'location_id' is the foreign key in PostJob
    }
}
