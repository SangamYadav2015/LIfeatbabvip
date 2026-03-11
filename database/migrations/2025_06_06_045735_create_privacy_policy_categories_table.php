<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivacyPolicyCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('privacy_policy_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('privacy_policy_categories');
    }
}
