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
        Schema::create('job_applications', function (Blueprint $table) {
    $table->id();
    
    $table->unsignedBigInteger('job_id');
    $table->unsignedBigInteger('applicant_id');
    $table->string('title');
$table->enum('status', [
    'pending','applied','screened','Shortlisted','Interview schedule','Background verification','hired','rejected'
])->default('pending');    $table->integer('progress')->default(0);

    $table->boolean('offer_letter_accepted')->default(false);
    $table->boolean('joining_letter_accepted')->default(false);
    $table->boolean('appointment_letter_accepted')->default(false);

    $table->string('offer_letter_path')->nullable();
    $table->string('joining_letter_path')->nullable();
    $table->string('appointment_letter_path')->nullable();
    $table->text('notification')->nullable();

    $table->timestamps();

    // ✅ Updated FK to match your `post_jobs` table
    $table->foreign('job_id')->references('id')->on('post_jobs')->onDelete('cascade');
    $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
