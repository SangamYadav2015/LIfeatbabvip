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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');                          // Type of notification
            $table->morphs('notifiable');                    // Polymorphic relation (can belong to different models)
            $table->text('data');                            // Data related to the notification (includes message)
            $table->boolean('offer_accepted')->default(0);   // Whether the offer was accepted or not
            $table->tinyInteger('job_id')->nullable();      // Tiny Integer for Job ID from the job application
            $table->tinyInteger('applicant_id')->nullable(); // Tiny Integer for Applicant ID (from applicant table)
            $table->string('link')->nullable();              // To store a link (e.g., interview schedule URL)

            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
