<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreviewImageToSectionStylesTable extends Migration
{
    public function up(): void
    {
        Schema::table('section_styles', function (Blueprint $table) {
            $table->string('preview_image')->nullable(); // Adjust position as needed
        });
    }

    public function down(): void
    {
        Schema::table('section_styles', function (Blueprint $table) {
            $table->dropColumn('preview_image');
        });
    }
}
