<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('default_measurements')->insert([
            'standard_measurement_id' => 1,
            'fit_option_id' => 1,
            'height' => 170,
            'weight' => 70,
            'cloth_measurement_id' => 1,
            'pants_measurement_id' => 1,
        ]);

        DB::table('default_measurements')->insert([
            'standard_measurement_id' => 1,
            'fit_option_id' => 2,
            'height' => 170,
            'weight' => 70,
            'cloth_measurement_id' => 2,
            'pants_measurement_id' => 2,
        ]);

        DB::table('default_measurements')->insert([
            'standard_measurement_id' => 2,
            'fit_option_id' => 1,
            'height' => 170,
            'weight' => 70,
            'cloth_measurement_id' => 3,
            'pants_measurement_id' => 3,
        ]);

        DB::table('default_measurements')->insert([
            'standard_measurement_id' => 2,
            'fit_option_id' => 2,
            'height' => 170,
            'weight' => 70,
            'cloth_measurement_id' => 4,
            'pants_measurement_id' => 4,
        ]);
    }
}
