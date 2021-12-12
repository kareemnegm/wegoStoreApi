<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price', 25, 2)->default('0.00')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('product_display')->default('https://via.placeholder.com/500/EE297E/343149?text=No+image');  
            $table->integer('rating_display')->default(0);
            $table->string('description',1000);
            $table->string('detail',1000);
            $table->integer('created_by')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
