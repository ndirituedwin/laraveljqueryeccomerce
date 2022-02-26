<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmspagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmspages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->string('title');
            $table->text('description');
            $table->string('slug')->nullable();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('cmspages');
    }
}
