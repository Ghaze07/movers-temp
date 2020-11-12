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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('farm_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->foreignId('order_status_id')->constrained();
            $table->float('order_total');
            $table->float('delivery_charges');
            $table->string('processing_option');
            $table->string('further_instructions')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_mobile');
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
