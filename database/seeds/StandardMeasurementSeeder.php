<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandardMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('standard_measurements')->insert([
            'name' => 'S',
            'description' => '',
            'order' => 1,
        ]);

        DB::table('standard_measurements')->insert([
            'name' => 'M',
            'description' => '',
            'order' => 2,
        ]);
    }
}
