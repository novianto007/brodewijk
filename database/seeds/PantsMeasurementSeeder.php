<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PantsMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pants_measurements')->insert([
            'waist' => 1,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);

        DB::table('pants_measurements')->insert([
            'waist' => 2,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);

        DB::table('pants_measurements')->insert([
            'waist' => 3,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);

        DB::table('pants_measurements')->insert([
            'waist' => 4,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);

        DB::table('pants_measurements')->insert([
            'waist' => 5,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);

        DB::table('pants_measurements')->insert([
            'waist' => 6,
            'seat' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'leg_length' => 6
        ]);
    }
}
