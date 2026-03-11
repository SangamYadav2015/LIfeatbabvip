<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category'); // Field for storing the category ID
            $table->string('blog_title');
            $table->string('blog_slug');
            $table->string('blog_image1')->nullable();
            $table->string('image1_alt')->nullable();
            $table->string('blog_image2')->nullable();
            $table->string('image2_alt')->nullable();
            $table->string('blog_image3')->nullable();
            $table->string('image3_alt')->nullable();
            $table->text('blog_short_details1');
            $table->text('blog_short_details2');
            $table->text('blog_details1')->nullable();
            $table->text('blog_details2')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('blog_category')->references('id')->on('blog_category')->onDelete('cascade'); // Correcting foreign key reference
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
