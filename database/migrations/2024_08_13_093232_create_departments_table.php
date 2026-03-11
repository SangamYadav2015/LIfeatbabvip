<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
     public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name'); 
            $table->timestamps(); 
        });

        DB::table('departments')->insert([
            [
                'department_name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'DATA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'BUSINESS STRATEGY & OPERATIONS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'CUSTOMER HAPINESS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'DESIGN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'ENGINEERING',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'FACILITIES & ADMIN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'FINANCE & LEGAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'MARKETING',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'PEOPLE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'PRODUCT MANAGEMENT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'DIGITAL MARKETING',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'SALES & SUCCESS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
