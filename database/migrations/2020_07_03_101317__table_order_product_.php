<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('image')->nullable();
            $table->text('description');
            $table->double('product_price');
            $table->double('extra_price')->default(0);
            $table->boolean('is_customized');
            $table->bigInteger('fabric_id');
            $table->bigInteger('fabric_color_id');
            $table->double('fabric_price');
            $table->text('note');
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
        Schema::dropIfExists('order_products');
    }
}
