<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('interview_availabilities', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->bigInteger('applicant_id')->constrained('applicants')->onDelete('cascade');  // Foreign key to applicants table
            $table->string('name');  // Store the applicant's name
            $table->string('email');  // Store the applicant's email
            $table->timestamp('available_from')->nullable();  // Nullable timestamp for availability start
            $table->timestamp('available_to')->nullable();  // Nullable timestamp for availability end
            $table->date('availability_date');  // The date of availability
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('interview_availabilities');  // Drop the table if it exists
    }
}


