<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
    use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id', 'name', 'email', 'password', 'designation', 'phone_number', 'alternate_phone_number', 'address', 'profile_image', 'status', 'google2fa_secret', 'google2fa_enabled',
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public static function validateRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|exists:User,email',
            'password' => 'required',
            'phone_number' => 'required',
            'status' => 'required',
        ];
    }

    public static function validateMessages()
    {
        return [
            'name.required' => 'Please Enter Full Name.',
            'email.required' => 'Please Enter Email ID.',
            'email.exists' => 'The Email Already Used.',
            'password.required' => 'Please Enter Password.',
            'phone_number.required' => 'Please Enter Phone Number.',
            'status.required' => 'Please ESelect Status.',
        ];
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'designation', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

public function sendPasswordResetNotification($token)
{
    $this->notify(new ResetPasswordNotification($token));
}

}
