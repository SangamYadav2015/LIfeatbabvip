<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing BIGINT primary key by default

            // Use bigInteger instead of foreignId
            $table->bigInteger('applicant_id')->unsigned();
            $table->bigInteger('job_id')->unsigned();

           

            $table->timestamps();

            // Prevent duplicate entries for the same applicant and job
            $table->unique(['applicant_id', 'job_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
