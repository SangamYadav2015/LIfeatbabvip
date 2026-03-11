<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('education_information', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('applicant_id'); // unsigned big integer for applicant_id
    $table->string('highest_education'); // e.g., 12th, Diploma, Degree, Masters

             // 10th
        $table->year('tenth_passout_year');
        $table->string('tenth_school');
        $table->string('tenth_board_name');
        $table->decimal('tenth_percentage', 5, 2);

        // 12th
        $table->year('twelfth_passout_year');
        $table->string('twelfth_school');
        $table->string('twelfth_board_name');
        $table->decimal('twelfth_percentage', 5, 2);
        $table->string('twelfth_stream');

        // Diploma
        $table->boolean('has_diploma')->default(0);
        $table->string('diploma_name')->nullable();
        $table->string('diploma_specialization')->nullable();
        $table->decimal('diploma_percentage', 5, 2)->nullable();
        $table->string('diploma_institution')->nullable();
        $table->year('diploma_passout_year')->nullable();

        // Degree
        $table->boolean('has_degree')->default(false);
        $table->string('degree_level')->nullable(); // B.A, B.Tech etc.
        $table->string('degree_specialization')->nullable();
        $table->decimal('degree_percentage', 5, 2)->nullable();
        $table->string('degree_institution')->nullable();
        $table->year('degree_passout_year')->nullable();

        // Post Graduation
        $table->string('masters_specialization')->nullable();
        $table->decimal('masters_percentage', 5, 2)->nullable();
        $table->string('masters_institution')->nullable();
        $table->year('masters_passout_year')->nullable();
 
             // Skills
             $table->text('skills_relevant')->nullable(); // Skills Relevant to the Job
            // 10th Class Details
           

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('education_information');
    }
};
