<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string("email", 80);
            $table->string("full_name", 100);
            $table->string("phone_number", 15);
            $table->double('total_price');
            $table->timestamp('deadline')->nullable();
            $table->string('promo_code', 100)->nullable();
            $table->double('discount_price')->default(0);
            $table->string('order_product_ids', 150);
            $table->text('shipment_address');
            $table->text('shipment_note');
            $table->string('snap_token')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
