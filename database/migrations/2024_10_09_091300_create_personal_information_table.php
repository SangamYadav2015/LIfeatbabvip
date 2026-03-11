<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id'); // unsigned big integer for applicant_id
            $table->unsignedBigInteger('job_id'); 
             $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('last_name');
   

    // Contact Info
    $table->string('email')->unique();
    $table->string('phone');

    // Gender
    $table->enum('gender', ['male', 'female', 'other'])->nullable();

    // Address Details
    $table->string('house_no')->nullable();
      $table->string('landmark')->nullable();
        $table->string('area')->nullable();
   
    $table->string('current_address');
    $table->string('permanent_address');
   
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->string('zip')->nullable();
    $table->string('country')->nullable();

    // DOB and Status
            $table->date('date_of_birth')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
