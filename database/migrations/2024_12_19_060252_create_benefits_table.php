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
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id'); // Foreign key to link to the applicant

            $table->string('annualgrosscompensation')->nullable();
            $table->string('fixedSalary')->nullable();
            $table->string('variablePay')->nullable();
            $table->string('otherbenefits')->nullable();
            $table->date('nextrevisiondate')->nullable(); 
           
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};
