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
            $table->double('front_length');
            $table->double('shoulder_width');
            $table->double('sleeve_length');
            $table->double('chest');
            $table->double('waist');
            $table->double('hips');
            $table->double('armpits');
            $table->double('biceps');
            $table->double('wrist');
            $table->double('front_chest');
            $table->double('back_chest');
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
