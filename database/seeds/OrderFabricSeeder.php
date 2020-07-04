<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderFabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_fabrics')->insert([
            'order_id' => 1,
            'fabric_id' => 1,
            'fabric_color_id' => 1,
            'price' => 2110000,
        ]);
    }
}
