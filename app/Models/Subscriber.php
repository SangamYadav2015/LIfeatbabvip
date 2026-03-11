<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'status',
        'ip_address',
    ];

    public static function validateRules()
    {
        return [
            'email' => 'required|email|max:255',
        ];
    }

    public static function validateMessages()
    {
        return [
            'email.required' => 'Please Enter Email.',
        ];
    }

    protected $casts = [
        'status' => 'boolean',
    ];
}
