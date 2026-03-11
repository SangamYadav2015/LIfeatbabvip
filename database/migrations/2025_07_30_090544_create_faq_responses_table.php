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
        Schema::create('faq_responses', function (Blueprint $table) {
            $table->id();
         $table->unsignedBigInteger('applicant_id')->unique(); // One row per applicant
    $table->json('responses')->nullable(); // Store all Q&A as JSON
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_responses');
    }
};
