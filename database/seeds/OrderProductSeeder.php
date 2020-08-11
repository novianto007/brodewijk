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
            'product_id' => 1,
            'product_price' => 2110000,
            'description' => '',
            'is_customized' => false,
            'fabric_id' => 1,
            'fabric_color_id' => 1,
            'fabric_price' => 2110000,
            'note' => '',
        ]);
    }
}
