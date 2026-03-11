<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('designation');
            $table->string('phone_number');
            $table->string('alternate_phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('status')->default(0);
        });
        DB::table('users')->insert([
            [
                'name' =>'ADMIN',
                'email' => 'admin@babvip.com',
                'password' =>'$2y$12$aL6PgxAJLyoNZmUo9kyovOnbTECjBsAwub9W6vr.xRrV0xrPp/fcm',
                'designation' => '1',
                'phone_number' => '00000000000',
                'alternate_phone_number' => '00000000000',
                'address' => 'Babvip Dehradun',
                'status' => '1',
                'profile_image' => 'admin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('designation');
            $table->dropColumn('phone_number');
            $table->dropColumn('alternate_phone_number');
            $table->dropColumn('address');
            $table->dropColumn('profile_image');
            $table->dropColumn('status');
        });
    }
};
