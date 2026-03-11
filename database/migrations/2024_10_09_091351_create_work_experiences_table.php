<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id'); // unsigned big integer for applicant_id

           $table->string('designation'); // New field for Designation
            $table->enum('employment_type', ['Remote', 'Hybrid', 'Full Time']); // Employment type
            $table->string('company_name');
            $table->boolean('current_working')->default(false);
            
            // Start and End Date (Month + Year separately)
            $table->string('start_month');
            $table->year('start_year');
            $table->string('end_month')->nullable();
            $table->year('end_year')->nullable();

            $table->string('location')->nullable();
            $table->string('salary_ctc')->nullable(); // Can store as string (e.g., "4 LPA", "5.5 Lakhs")

            $table->string('skills')->nullable(); // Store comma-separated skill names (or move to a new table if needed)

            $table->text('position')->nullable(); // Responsibilities and achievements
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
