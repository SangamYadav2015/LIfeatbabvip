<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table = 'user_role';

 
    protected $fillable = [
        'department_id',
        'role_title',
        'role',
    ];
    protected $casts = [
        'role' => 'array', // Automatically cast the 'role' attribute to an array
    ];

    public static function validateRules()
    {
        return [
            'role_title' => 'required|exists:UserRole,role_title',
        ];
    }

    public static function validateMessages()
    {
        return [
            'role_title' => 'Please Enter Role Name.',
            'role_title.exists' => 'The role already used.',
        ];
    }


    public function department(){
        return $this->hasOne(Department::class, 'id','department_id');
    }

}
