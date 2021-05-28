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
            $table->bigInteger('section_id');
            $table->bigInteger('category_id');
            $table->string('productname');
            $table->string('productcode');
            $table->string('productcolor');
            $table->float('productprice');
            $table->float('productdiscount');
            $table->string('productweight');
            $table->string('productimage');
            $table->text('productdescrition');
            $table->string('washcare');
            $table->string('fabric');
            $table->string('pattern');
            $table->string('sleeve');
            $table->string('fit');
            $table->string('occassion');
            $table->string('metattitle');
            $table->string('metadescription');
            $table->string('metakeyword');
            $table->enum('featured',['no','yes']);
            $table->tinyInteger('status');
            
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
        Schema::dropIfExists('products');
    }
}
