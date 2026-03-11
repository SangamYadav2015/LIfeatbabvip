<?php
namespace App\Models; // Ensure this is correct

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'applicant_id', 'title'];

    public function postJob()
    {
        return $this->belongsTo(PostJob::class, 'job_id');
    }
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class, 'job_id');
    }

    public function job()
{
    return $this->belongsTo(PostJob::class, 'job_id'); // Adjust the foreign key
}

}
