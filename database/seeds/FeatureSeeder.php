<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Lining',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Canvas Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shoulder Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Lapels',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Chest Pocket',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Buttons',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pockets',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vents',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pants',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vest',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shirt',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Tie',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'value',
            'name' => 'Monogram',
            'description' => ''
        ]);
    }
}
