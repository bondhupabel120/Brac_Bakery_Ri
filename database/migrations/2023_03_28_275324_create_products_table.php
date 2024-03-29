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
            $table->bigInteger('category_id')->unsigned();
            $table-> string('name');
            $table-> string('description')-> nullable();
            $table->decimal('price',8,2); //99999.9
            $table->decimal('sale_price',8,2)-> nullable(); 
            $table->integer('quantity'); 
            $table->string('category')->nullable(); 
            $table->string('type')->nullable(); 
            $table->string('image')->nullable();
            $table->string('image1')-> nullable(); 
            $table->string('image2')-> nullable(); 
            $table->tinyInteger('status')->default(1)->nullable()->comment('1=>Active, 0 =>Deactive');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
};
