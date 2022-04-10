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
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('price');
            $table->string('main_image');
            $table->string('video');
            $table->string('quantity');
            $table->string('special_price')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('added_by')->unsigned();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_active');
            $table->boolean('featured');

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
