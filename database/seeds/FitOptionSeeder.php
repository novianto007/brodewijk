<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FitOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fit_options')->insert([
            'name' => 'Regular Fit',
            'description' => ''
        ]);

        DB::table('fit_options')->insert([
            'name' => 'Slim Fit',
            'description' => ''
        ]);
    }
}
