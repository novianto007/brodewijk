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
            'name_id' => 'Lining',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Canvas Type',
            'name_id' => 'Canvas Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shoulder Type',
            'name_id' => 'Shoulder Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Lapels',
            'name_id' => 'Lapels',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Chest Pocket',
            'name_id' => 'Chest Pocket',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Buttons',
            'name_id' => 'Buttons',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pockets',
            'name_id' => 'Pockets',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vents',
            'name_id' => 'Vents',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pants',
            'name_id' => 'Pants',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vest',
            'name_id' => 'Vest',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shirt',
            'name_id' => 'Shirt',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Tie',
            'name_id' => 'Tie',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'value',
            'name' => 'Monogram',
            'name_id' => 'Monogram',
            'description' => ''
        ]);
    }
}
