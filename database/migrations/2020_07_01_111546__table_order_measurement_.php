<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableOrderMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_measurements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_product_id');
            $table->string('method', 20);
            $table->bigInteger('standard_measurement_id')->nullable();
            $table->bigInteger('fit_option_id');
            $table->double('height');
            $table->double('weight');
            $table->bigInteger('cloth_measurement_id')->nullable();
            $table->bigInteger('pants_measurement_id')->nullable();
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
        Schema::dropIfExists('order_measurements');
    }
}
