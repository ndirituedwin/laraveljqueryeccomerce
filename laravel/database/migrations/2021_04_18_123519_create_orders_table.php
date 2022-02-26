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
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->float('shippingcharges')->nullable();
            $table->string('couponcode')->nullable();
            $table->float('couponamount')->nullable();
            $table->string('orderstatus')->nullable();
            $table->string('paymentmethod')->nullable();
            $table->string('paymentgateway')->nullable();
            $table->float('grandtotal');
            $table->timestamps();
            $table->softDeletes();
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
