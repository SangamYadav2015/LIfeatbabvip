<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('show_header')->default(false);
            $table->boolean('show_footer')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_id')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
