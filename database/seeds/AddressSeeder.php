<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'customer_id' => 1,
            'title' => 'rumah',
            'address' => 'jl. yang lurus no. 1',
            'province_id' => 31,
            'city_id' => 3101,
            'district_id' => 310101,
            'postcode' => 4744,
            'note' => '',
        ]);
    }
}
