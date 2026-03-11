<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpFaqTable extends Migration
{
    public function up()
    {
        Schema::create('help_faq', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->string('question');
            $table->text('answer');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();

            // If you want to add a foreign key constraint on category_id
            $table->foreign('category_id')->references('id')->on('help_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_faq');
    }
}
