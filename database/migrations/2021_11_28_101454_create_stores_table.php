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
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('store_theme')->nullable(true);
            $table->string('theme_dir')->nullable(true);
            $table->string('store_link')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('whatsapp')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->unsignedBigInteger('store_owner_id');
            $table->unsignedBigInteger('plan_id');
             $table->timestamps();

             //foreignkey
             $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('store_owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade')->onUpdate('cascade');

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
