<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FarmProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farm_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('product_source_id');
            $table->boolean('in_stock')->default(true);
            $table->float('minimum_order_quantity')->default(3);
            $table->float('maximum_order_quantity')->default(20);
            $table->float('unit_price')->default(0.0);
            $table->integer('measuring_unit_id')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('farm_id')
                ->references('id')
                ->on('farms')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_products');
    }
}
