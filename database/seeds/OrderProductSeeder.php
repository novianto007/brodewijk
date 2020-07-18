<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_products')->insert([
            'order_id' => 1,
            'product_id' => 1,
            'product_price' => 2110000,
            'description' => '',
            'is_customized' => false,
            'fabric_color_id' => 1,
            'fabric_price' => 2110000,
            'note' => '',
        ]);
    }
}
