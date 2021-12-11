<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('currency');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->string('about');
            $table->string('logo');
            $table->boolean('is_active')->default(true);
            $table->string('store_theme');
            $table->string('theme_dir');
            $table->string('store_link');
            $table->string('facebook');
            $table->string('whatsapp');
            $table->string('instagram');
            $table->string('twitter');
             $table->timestamps();

             //foreignkey
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
        Schema::dropIfExists('stores');
    }
}
