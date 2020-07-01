<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableDefaultMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_measurements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('standard_measurement_id');
            $table->bigInteger('fit_option_id');
            $table->double('height');
            $table->double('weight');
            $table->bigInteger('cloth_measurement_id');
            $table->bigInteger('pants_measurement_id');
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
        Schema::dropIfExists('default_measurements');
    }
}
