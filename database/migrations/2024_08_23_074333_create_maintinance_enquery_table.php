<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintinanceEnqueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintinance_enquery', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('first_name'); // Field for the first name
            $table->string('last_name'); // Field for the last name
            $table->string('email'); // Field for the email
            $table->string('phone'); // Field for the phone number
            $table->string('subject'); // Field for the subject of the query
            $table->text('message'); // Field for the message or inquiry details
            $table->string('ip_address'); // Field for the IP address
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintinance_enquery');
    }
}
