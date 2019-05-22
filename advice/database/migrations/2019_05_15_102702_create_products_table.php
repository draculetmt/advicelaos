<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('product_id');
            $table->integer('cat_id');
            $table->integer('brand_id');
            $table->string('product_image');
            $table->string('product_bar');
            $table->string('product_name');
            $table->longText('product_short_desc');
            $table->longText('product_long_desc');
            $table->string('product_size');
            $table->string('product_color');
            $table->integer('unit_id');
            $table->float ('product_price');
            $table->integer('publication_status');
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
