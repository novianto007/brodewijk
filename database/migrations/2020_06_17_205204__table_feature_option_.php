<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableFeatureOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("feature_id");
            $table->string("code_name", 100)->nullable();
            $table->string("name", 100);
            $table->string("image", 200)->nullable();
            $table->boolean("is_has_child");
            $table->text("description");
            $table->text("description_ind");
            $table->bigInteger("resource_depend")->nullable();
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
        Schema::dropIfExists('feature_options');
    }
}
