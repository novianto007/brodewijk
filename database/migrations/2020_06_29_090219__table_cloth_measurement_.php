<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableClothMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloth_measurements', function (Blueprint $table) {
            $table->id();
            $table->double('neck');
            $table->double('shoulder');
            $table->double('bicep');
            $table->double('arm_length');
            $table->double('wrist');
            $table->double('torso_length');
            $table->double('chest');
            $table->double('stomach');
            $table->double('waist');
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
        Schema::dropIfExists('cloth_measurements');
    }
}
