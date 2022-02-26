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
            $table->bigInteger('admin_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
       //     $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('productname');
            $table->string('slug');
            $table->string('productcode');
            $table->string('productcolor');
            $table->float('productprice');
            $table->float('productdiscount')->default(0.0);
            $table->string('productweight');
            $table->string('productimage');
            $table->text('productdescription');
            $table->string('washcare')->nullable();
            $table->string('fabric')->nullable();
            $table->string('pattern')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('fit')->nullable();
            $table->string('occassion')->nullable();
            $table->string('metattitle')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('metakeyword')->nullable();
            $table->tinyInteger('featured');
            $table->tinyInteger('status');
            $table->index('admin_id');
            $table->index('category_id');
            $table->index('section_id');
       //     $table->index('brand_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('restrict')->onUpdate('no action');
           // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('products');
    }
}
