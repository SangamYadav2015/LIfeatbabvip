<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivacyPolicyFaqsTable extends Migration
{
    public function up()
    {
        Schema::create('privacy_policy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();

            // $table->foreign('category_id')
            //       ->references('id')
            //       ->on('privacy_policy_categories')
            //       ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('privacy_policy_faqs');
    }
}
