<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('logs', function (Blueprint $table) {
        $table->enum('status', ['New', 'Progress', 'Resolved'])->default('New');
    });
}

public function down()
{
    Schema::table('logs', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
