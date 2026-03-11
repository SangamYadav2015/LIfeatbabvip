<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['applicant_id','job_id' ,'message', 'is_read','offer_accepted'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    

    public function job()
    {
        return $this->belongsTo(PostJob::class);
    }

    protected $guarded = [];
    protected $keyType = 'string';  // Specify that the primary key is a string (UUID)
    public $incrementing = false;  

    // Assuming `notifiable` will be a polymorphic relationship
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    // You can also add a method to update the offer acceptance status
    public function acceptOffer()
    {
        $this->offer_accepted = 1;
        $this->save();
    }

}
