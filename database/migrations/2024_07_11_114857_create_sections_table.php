<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('sections')->insert([
            [
                'section_name' => 'Hero',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Testimonial',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Call To Action',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Tab',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Service',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Work Process',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Pricing',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Faq',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Feature',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Integration',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Our Team',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Blog',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Contact',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Help Center',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Career',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Department',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'section_name' => 'Location',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Portfolio',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_name' => 'Privacy & Terms',
                'status' => 1,
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
        Schema::dropIfExists('sections');
    }
}
