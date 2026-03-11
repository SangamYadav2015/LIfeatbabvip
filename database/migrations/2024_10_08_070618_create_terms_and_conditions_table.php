<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('terms_and_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the terms and conditions
            $table->text('content'); // Content of the terms and conditions

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('terms_and_conditions');
    }
};
