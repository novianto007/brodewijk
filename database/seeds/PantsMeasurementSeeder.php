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
            'pants_length' => 1,
            'trouser_waist' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'ankle' => 6,
            'pants_hips' => 7,
        ]);

        DB::table('pants_measurements')->insert([
            'pants_length' => 2,
            'trouser_waist' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'ankle' => 6,
            'pants_hips' => 7,
        ]);

        DB::table('pants_measurements')->insert([
            'pants_length' => 3,
            'trouser_waist' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'ankle' => 6,
            'pants_hips' => 7,
        ]);

        DB::table('pants_measurements')->insert([
            'pants_length' => 4,
            'trouser_waist' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'ankle' => 6,
            'pants_hips' => 7,
        ]);

        DB::table('pants_measurements')->insert([
            'pants_length' => 5,
            'trouser_waist' => 2,
            'crotch' => 3,
            'thigh' => 4,
            'knee' => 5,
            'ankle' => 6,
            'pants_hips' => 7,
        ]);
    }
}
