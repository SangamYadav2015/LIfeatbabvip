<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id'); // Allows NULL values
            $table->string('role_title');
            $table->json('role'); // Store the array in JSON format
            $table->timestamps();
        });
        DB::table('user_role')->insert([
            [
                'department_id' => '1',
                'role_title' => 'Admin',
                'role' => '["manage_menu","manage_section","manage_section_style","manage_pages","manage_user","manage_logs","manage_news","manage_team","setting","manage_enquery","manage_help","manage_location","manage_terms","manage_career"]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
