<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 1,
            'option_value' => 1,
            'child_value' => 1,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 2,
            'option_value' => 3,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 3,
            'option_value' => 5,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 4,
            'option_value' => 8,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 5,
            'option_value' => 9,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 6,
            'option_value' => 12,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 7,
            'option_value' => 13,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 8,
            'option_value' => 15,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 9,
            'option_value' => 18,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 10,
            'option_value' => 19,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 11,
            'option_value' => 21,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 12,
            'option_value' => 23,
            'child_value' => null,
            'string_value' => null
        ]);

        DB::table('product_features')->insert([
            'product_id' => 1,
            'feature_id' => 13,
            'option_value' => 25,
            'child_value' => null,
            'string_value' => "joss"
        ]);
    }
}
