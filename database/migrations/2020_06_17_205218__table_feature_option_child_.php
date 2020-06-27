<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableFeatureOptionChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_option_children', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("feature_option_id");
            $table->string("name", 100);
            $table->string("image", 200)->nullable();
            $table->text("resources")->nullable();
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
        Schema::dropIfExists('feature_option_children');
    }
}
