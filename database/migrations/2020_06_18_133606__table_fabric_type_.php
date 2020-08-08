<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableFabricType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("category_id");
            $table->string("name", 100);
            $table->double("base_price");
            $table->double("base_price_margin");
            $table->double("extra_price");
            $table->double("extra_price_margin");
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
        Schema::dropIfExists('fabric_types');
    }
}
