<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    
    // Specify the table name if it's not the plural of the model name
    protected $table = 'companies';

    // Specify the primary key if it's not 'id'

    // Define the fields that are mass assignable
    protected $fillable = [
        'company_name',
    ];

    public function postJobs()
    {
        return $this->hasMany(PostJob::class);
    }
}
