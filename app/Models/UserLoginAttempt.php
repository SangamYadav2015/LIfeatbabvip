<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginAttempt extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'user_login_attempts';

    // Specify the fillable fields
    protected $fillable = [
        'ip_address',
        'email',
        'user_id',
        'created_at',
    ];

    // Disable timestamps if you don't need updated_at
    public $timestamps = false;

    // Optionally, define a relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
