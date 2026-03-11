<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'job_id'];

    // Relationship to the Applicant (user) model
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    // Relationship to the Job model
    public function job()
    {
        return $this->belongsTo(PostJob::class);
    }
}

