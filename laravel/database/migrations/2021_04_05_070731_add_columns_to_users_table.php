<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     // Schema::table('users', function (Blueprint $table) {
    //     //     $table->string('address')->after('last_name')->nullable();
    //     //     $table->string('city')->after('address')->nullable();
    //     //     $table->string('state')->after('city')->nullable();
    //     //     $table->string('country')->after('state')->nullable();
    //     //     //$table->string('country')->after('state')->nullable();
    //     //     $table->string('pincode')->after('country')->nullable();
    //     //     $table->string('mobile')->after('pincode')->nullable();
    //     //     $table->tinyInteger('status')->after('mobile');

    //     //     //
    //     // });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->dropColumn('address');
    //         $table->dropColumn('city');
    //         $table->dropColumn('state');
    //         $table->dropColumn('country');
    //         $table->drop('pincode');
    //         $table->drop('mobile');
    //         $table->dropColumn('status');

    //     });
    // }
}
