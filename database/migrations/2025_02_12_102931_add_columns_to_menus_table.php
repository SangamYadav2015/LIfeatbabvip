<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->boolean('is_horizontal')->default(0); // Change 'some_existing_column' as needed
            $table->string('menu_image')->nullable();
            $table->text('menu_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['is_horizontal', 'menu_image', 'menu_description']);
        });
    }
};
