<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClothMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cloth_measurements')->insert([
            'neck' => 1,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);

        DB::table('cloth_measurements')->insert([
            'neck' => 2,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);

        DB::table('cloth_measurements')->insert([
            'neck' => 3,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);

        DB::table('cloth_measurements')->insert([
            'neck' => 4,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);

        DB::table('cloth_measurements')->insert([
            'neck' => 5,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);

        DB::table('cloth_measurements')->insert([
            'neck' => 6,
            'shoulder' => 2,
            'bicep' => 3,
            'chest' => 4,
            'waist' => 5,
            'arm_length' => 6,
            'torso_length' => 7,
            'stomach' => 8,
            'wrist' => 9
        ]);
    }
}
