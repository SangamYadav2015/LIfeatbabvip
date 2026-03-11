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
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('job_slug');
           
            $table->tinyInteger('company_id'); // Updated to reference companies table
            $table->tinyInteger('department_id');
            $table->tinyInteger('location_id');
            $table->string('type');
            $table->string('designation');

            $table->decimal('minimum_salary', 10, 2)->nullable();
            $table->decimal('maximum_salary', 10, 2)->nullable();          
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            
            $table->boolean('salary_disclosed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_jobs');
    }
};
