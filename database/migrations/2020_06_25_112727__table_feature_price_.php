<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableFeaturePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("fabric_type_id");
            $table->bigInteger("feature_option_id");
            $table->double("price");
            $table->double("price_margin");
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
        Schema::dropIfExists('feature_prices');
    }
}
