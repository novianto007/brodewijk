<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableFabricColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_colors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("fabric_id");
            $table->string("name", 100);
            $table->string("image", 200);
            $table->string("code", 80)->nullable();
            $table->string("path", 250)->nullable();
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
        Schema::dropIfExists('fabric_colors');
    }
}
