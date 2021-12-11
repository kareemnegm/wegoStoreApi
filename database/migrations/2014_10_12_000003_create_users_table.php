<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
               ///foreign keys

               $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}
