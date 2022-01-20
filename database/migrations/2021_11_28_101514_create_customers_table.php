<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('city_id');
            $table->integer('phone_number');
            $table->string('street_name');
            $table->string('building_number');
            $table->string('flat_number');
            $table->string('address_notes',1000);
            $table->timestamps();

            //foreign key
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
