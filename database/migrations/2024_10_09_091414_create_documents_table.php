<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id'); // Foreign key to link to the applicant

            $table->string('Resume')->nullable();
            $table->string('aadhar_card_front')->nullable();
            $table->string('aadhar_card_back')->nullable();
            $table->string('pan_card')->nullable();
            
            $table->string('passport_size_photographs')->nullable(); // Can store paths to multiple images if necessary
        $table->enum('passport', ['Yes', 'No'])->default('No');
    $table->string('passport_file')->nullable();

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
