<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEnquery extends Model
{
    use HasFactory;

    protected $table = 'contact_enquery';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'subject',
        'ip_address',
    ];

    public static function validateRules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:20',
            'message' => 'required|string',
        ];
    }

    public static function validateMessages()
    {
        return [
            'first_name.required' => 'Please Enter First Name.',
            'last_name.required' => 'Please Enter Last Name.',
            'email.required' => 'Please Enter  Email.',
            'phone.required' => 'Please Enter  phone.',
            'subject.required' => 'Please Enter  Subject.',
            'message.required' => 'Please Enter Message.',
        ];
    }

}
