<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Authenticatable{
    use HasFactory;
    use Notifiable;

protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'email',
    'phone',
    'gender',
    'country',
    'state',
    'city',
    'current_address',
    'permanent_address',
    'resume',
    'cover_letter',
    'portfolio',
    'password',
    'email_verified_at',
    'terms_accepted',
    'login_token',
    'login_token_expires_at',
    'last_login_at',
    'profile_image',
    'offer_letter_path',
    'notification',
    'google2fa_enabled',
    'google2fa_secret',
    'status',
];
    
    protected $hidden = ['password', 'remember_token'];
    
    // In App\Models\Applicant.php

public function applicant()
{
    return $this->belongsTo(User::class, 'user_id'); // or whatever is appropriate
}

   public function faqResponses()
{
    return $this->hasMany(FaqResponse::class, 'applicant_id');
}
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

     public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class);
    }

    

    public function workExperience()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function documents()
    {
        // Assuming the documents table has an 'applicant_id' foreign key
        return $this->hasMany(Document::class, 'applicant_id'); // Adjust the 'applicant_id' if necessary
    }

    public function wishlist()
    {
        return $this->belongsToMany(PostJob::class, 'wishlists', 'applicant_id', 'job_id');
    }

    public function benefits()
    {
        // Assuming the benefits table has an 'applicant_id' foreign key
        return $this->hasMany(Benefits::class); // Adjust the 'applicant_id' if necessary
    }

    public function educationInformation()
{
    // Ensure this relationship is defined correctly
    return $this->hasOne(EducationInformation::class);  // If one education per applicant
}
public function profileImage()
{
    // Assuming `passport_size_photographs` is a file path or the field that stores the profile image.
    return $this->hasOne(Document::class)->whereNotNull('passport_size_photographs');
}

// In your Applicant Model

public function acceptOfferLetter()
{
    $this->offer_letter_accepted = true;
    $this->save();

    // Send the Joining Letter Notification after offer letter acceptance
    $this->sendJoiningLetterNotification();
}
public static function registerRules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:applicants,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ];
}

public static function registerMessages()
{
    return [
        'name.required' => 'Name is required.',
        'name.string' => 'Name must be a string.',
        'name.max' => 'Name cannot exceed 255 characters.',

        'email.required' => 'Email is required.',
        'email.email' => 'Please provide a valid email address.',
        'email.unique' => 'This email is already registered.',

        'phone.required' => 'Phone number is required.',
        'phone.string' => 'Phone number must be a string.',
        'phone.max' => 'Phone number cannot exceed 20 characters.',

        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];
}


public static function loginRules()
{
    return [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ];
}

public static function loginMessages()
{
    return [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'The email format is invalid.',
        'password.required' => 'Please enter your password.',
        'password.min' => 'Password must be at least 8 characters.',
    ];
}

public static function createauth(array $attributes)
{
    if (isset($attributes['password'])) {
        $attributes['password'] = bcrypt($attributes['password']);
    }

    return self::create($attributes);
}

}

