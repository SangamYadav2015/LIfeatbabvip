<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoiningLetterNotification extends Model
{
    
    use HasFactory;

    protected $fillable = ['notification_id', 'joining_letter_link', 'is_downloaded'];

    // Define relationship with Notification model (if applicable)
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
