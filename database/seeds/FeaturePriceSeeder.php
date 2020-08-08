<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 1,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 2,
            'price' => 200000,
            'price_margin' => 20000
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 3,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 4,
            'price' => 250000,
            'price_margin' => 25000,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 5,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 6,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 7,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 8,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 9,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 10,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 11,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 12,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 13,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 14,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 15,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 16,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 17,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 18,
            'price' => 775000,
            'price_margin' => 77500,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 19,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 20,
            'price' => 695000,
            'price_margin' => 69500,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 21,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 22,
            'price' => 350000,
            'price_margin' => 35000,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 23,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 24,
            'price' => 25000,
            'price_margin' => 2500,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 25,
            'price' => 0,
            'price_margin' => 0,
        ]);
        DB::table('feature_prices')->insert([
            'fabric_type_id' => 1,
            'feature_option_id' => 26,
            'price' => 100000,
            'price_margin' => 10000,
        ]);
    }
}
