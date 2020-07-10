<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_measurements')->insert([
            'order_product_id' => 1,
            'method' => 'manual',
            'standard_measurement_id' => null,
            'fit_option_id' => 1,
            'height' => 160,
            'weight' => 60,
            'cloth_measurement_id' => 6,
            'pants_measurement_id' => 6
        ]);
    }
}
