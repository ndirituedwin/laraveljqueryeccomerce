<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->string('0-500g')->after('country_name');
            $table->string('501-1000g')->after('0-500g');
            $table->string('1001-2000g')->after('501-1000g');
            $table->string('2001-5000g')->after('1001-2000g');
            $table->string('above_5000g')->after('2001-5000g');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            //
        });
    }
}
