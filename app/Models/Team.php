<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'team_image',
        'designation',
        'linkedin_url',
        'about',
        'status',
        'facebook_url',
        'instagram_url'
    ];

    public static function validateRules($id = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'linkedin_url' => 'required|string',
            'about' => 'required|string',
            'status' => 'required|boolean',
        ];

       
        return $rules;
}

public static function validateMessages()
{
    return [
        'name.required' => 'The name field is required.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name may not be greater than :max characters.',

        'lastname.required' => 'The lastname field is required.',
        'lastname.string' => 'The lastname must be a string.',
        'lastname.max' => 'The lastname may not be greater than :max characters.',

        'designation.required' => 'The designation field is required.',
        'designation.string' => 'The designation must be a string.',
        'designation.max' => 'The designation may not be greater than :max characters.',
       
        'about.required' => 'The about field is required.',
        'about.string' => 'The about must be a string.',

        'linkedin.required' => 'The Linkedin field is required.',
        'linkedin.string' => 'The Linkedin must be a string.',
        
    
        'status.required' => 'The status field is required.',
        'status.boolean' => 'The status field must be true or false.',
        
    ];
}
}
