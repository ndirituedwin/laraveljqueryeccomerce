<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned();
            $table->bigInteger('parent_id');
            $table->bigInteger('section_id');
            $table->string('categoryname');
            $table->string('slug');
            $table->string('categoryimage')->nullable();
            $table->float('categorydiscount');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('metatitle')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('metakeywords')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
            $table->index('admin_id');
            $table->index('section_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
