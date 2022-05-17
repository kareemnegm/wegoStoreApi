<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->bigInteger('card_number');
            $table->smallInteger('card_exp_day');
            $table->smallInteger('card_exp_month');
            $table->integer('card_exp_year');
            $table->string('shipping_data',1000);
            $table->double('price');
            $table->string('coupon');
            $table->double('net_price_discount');
            $table->tinyInteger('status');
            $table->enum('payment',['true','false'])->default('false');
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
