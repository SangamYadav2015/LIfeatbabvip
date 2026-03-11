<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            // Basic Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Address
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('current_address');
            $table->string('permanent_address');

            // Documents
            $table->string('resume'); // Required
            $table->string('cover_letter')->nullable(); // Optional
            $table->string('portfolio')->nullable(); // Optional

            // Authentication
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();

            // Terms and tracking
            $table->boolean('terms_accepted')->default(0);
            $table->string('login_token', 199)->nullable();
            $table->timestamp('login_token_expires_at')->nullable();
            $table->timestamp('last_login_at')->nullable();

            // Optional profile fields
            $table->string('profile_image')->nullable();
            $table->string('offer_letter_path')->nullable();
            $table->text('notification')->nullable();

            // Google 2FA
            $table->string('google2fa_enabled')->nullable();
            $table->string('google2fa_secret')->nullable();

            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('applicants');
        
    }
};
