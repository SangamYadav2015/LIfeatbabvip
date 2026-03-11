<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLoginAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('user_login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45); // IPv4 or IPv6
            $table->string('email');
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable in case the email doesn't exist in the user table
            $table->boolean('status')->default(0); // Add status column with default value 0
            $table->timestamps(); // Automatically adds `created_at` and `updated_at` columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_login_attempts');
    }
}
