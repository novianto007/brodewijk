<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabric_types')->insert([
            'category_id' => 1,
            'name' => 'Wool',
            'base_price' => '2110000',
            'extra_price' => '400000',
            'base_price_margin' => '211000',
            'extra_price_margin' => '40000'
        ]);

        DB::table('fabric_types')->insert([
            'category_id' => 1,
            'name' => 'Semi Wool',
            'base_price' => '1520000',
            'extra_price' => '150000',
            'base_price_margin' => '152000',
            'extra_price_margin' => '15000'
        ]);
    }
}
