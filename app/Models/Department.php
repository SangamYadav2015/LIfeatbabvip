<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $fillable = [
        'Department_name',
        'short_description',
        'department_image',
        // Add any other fields
    ];

    public static function validateRules()
    {
        return [
            'Department_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'department_image' => 'nullable|image|max:2048', // Adjust as necessary
            // Add other validation rules as needed
        ];
    }

    public static function validateMessages()
    {
        return [
            'Department_name.required' => 'The department name is required.',
            'Department_name.string' => 'The department name must be a string.',
            'Department_name.max' => 'The department name must not exceed 255 characters.',
            // Add other custom messages as necessary
        ];
    }

    public function UserRole(){
        return $this->hasMany(UserRole::class, 'department_id','id');
    }
}
