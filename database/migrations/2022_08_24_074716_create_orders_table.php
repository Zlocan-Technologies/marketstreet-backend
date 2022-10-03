<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('order_no')->unique();
            $table->integer('total')->unsigned();
            $table->integer('subtotal')->unsigned();
            $table->integer('shipping_cost')->unsigned();
            $table->integer('subcharge')->unsigned();
            $table->string('reference')->unique();
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('order_status', ['pending', 'completed', 'cancelled', 'in progress'])->default('pending');
            $table->enum('payment_channel', ['FLUTTERWAVE', 'PAYSTACK'])->nullable();
            $table->string('coupon_code')->nullable();
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
};
