<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizePreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size_preferences')->insert([
            'fit_option_id' => 2,
            'customer_id' => 1,
            'height' => 175,
            'weight' => 70,
            'cloth_measurement_id' => 5,
            'pants_measurement_id' => 5,
        ]);
    }
}
