<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicant_information', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('applicant_id');
            $table->tinyInteger('post_job_id');
            $table->string('full_name');
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
 
            // Job Information
            $table->string('job_title')->nullable();
            $table->decimal('salary_desired', 8, 2)->nullable();
            $table->date('available_start_date')->nullable();
 
            // Education Information
            $table->string('highest_education')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('degree_earned')->nullable();
            $table->year('graduation_year')->nullable();
 
            // Work Experience - Most Recent Job
            $table->string('most_recent_job_title')->nullable();
            $table->string('most_recent_company_name')->nullable();
            $table->string('most_recent_employment_dates')->nullable();  // (From - To)
            $table->text('most_recent_responsibilities')->nullable();
 
            // Work Experience - Previous Job
            $table->string('previous_job_title')->nullable();
            $table->string('previous_company_name')->nullable();
            $table->string('previous_employment_dates')->nullable();  // (From - To)
            $table->text('previous_responsibilities')->nullable();
 
            // Skills and Qualifications
            $table->text('skills')->nullable();
            $table->text('certifications')->nullable();
 
          
 
            // Attachments
            $table->string('resume')->nullable();  // Store file path for resume
            $table->string('cover_letter')->nullable();  // Store file path for cover letter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_information');
    }
};
