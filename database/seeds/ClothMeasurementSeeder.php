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
            'front_length' => 1,
            'shoulder_width' => 2,
            'sleeve_length' => 3,
            'chest' => 4,
            'waist' => 5,
            'hips' => 6,
            'armpits' => 7,
            'biceps' => 8,
            'wrist' => 9,
            'front_chest' => 10,
            'back_chest' => 11,
        ]);

        DB::table('cloth_measurements')->insert([
            'front_length' => 2,
            'shoulder_width' => 2,
            'sleeve_length' => 3,
            'chest' => 4,
            'waist' => 5,
            'hips' => 6,
            'armpits' => 7,
            'biceps' => 8,
            'wrist' => 9,
            'front_chest' => 10,
            'back_chest' => 11,
        ]);

        DB::table('cloth_measurements')->insert([
            'front_length' => 3,
            'shoulder_width' => 2,
            'sleeve_length' => 3,
            'chest' => 4,
            'waist' => 5,
            'hips' => 6,
            'armpits' => 7,
            'biceps' => 8,
            'wrist' => 9,
            'front_chest' => 10,
            'back_chest' => 11,
        ]);

        DB::table('cloth_measurements')->insert([
            'front_length' => 4,
            'shoulder_width' => 2,
            'sleeve_length' => 3,
            'chest' => 4,
            'waist' => 5,
            'hips' => 6,
            'armpits' => 7,
            'biceps' => 8,
            'wrist' => 9,
            'front_chest' => 10,
            'back_chest' => 11,
        ]);

        DB::table('cloth_measurements')->insert([
            'front_length' => 5,
            'shoulder_width' => 2,
            'sleeve_length' => 3,
            'chest' => 4,
            'waist' => 5,
            'hips' => 6,
            'armpits' => 7,
            'biceps' => 8,
            'wrist' => 9,
            'front_chest' => 10,
            'back_chest' => 11,
        ]);
    }
}
