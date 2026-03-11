<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintinanceEnquery extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'maintinance_enquery';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
        'ip_address',
    ];

    // Optionally, you can specify the attributes that are cast to a specific data type
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
