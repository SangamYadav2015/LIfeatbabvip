<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoginFieldsToApplicantsTable extends Migration
{
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('login_token')->nullable()->after('remember_token');
            $table->timestamp('login_token_expires_at')->nullable()->after('login_token');
            $table->timestamp('last_login_at')->nullable()->after('login_token_expires_at');
        });
    }

    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn(['login_token', 'login_token_expires_at', 'last_login_at']);
        });
    }
}
