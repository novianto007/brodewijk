<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePantsMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pants_measurements', function (Blueprint $table) {
            $table->id();
            $table->double('pants_length');
            $table->double('trouser_waist');
            $table->double('crotch');
            $table->double('thigh');
            $table->double('knee');
            $table->double('ankle');
            $table->double('pants_hips');
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
        Schema::dropIfExists('pants_measurements');
    }
}
