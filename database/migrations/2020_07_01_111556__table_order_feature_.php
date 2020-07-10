<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableOrderFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_product_id');
            $table->bigInteger('feature_id');
            $table->bigInteger('option_value')->nullable();
            $table->bigInteger('child_value')->nullable();
            $table->string('string_value', 120)->nullable();
            $table->double('price');
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
        Schema::dropIfExists('order_features');
    }
}
