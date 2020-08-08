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
            'name_ind' => 'Lining',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Canvas Type',
            'name_ind' => 'Canvas Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shoulder Type',
            'name_ind' => 'Shoulder Type',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Lapels',
            'name_ind' => 'Lapels',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Chest Pocket',
            'name_ind' => 'Chest Pocket',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Buttons',
            'name_ind' => 'Buttons',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pockets',
            'name_ind' => 'Pockets',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vents',
            'name_ind' => 'Vents',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Pants',
            'name_ind' => 'Pants',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Vest',
            'name_ind' => 'Vest',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Shirt',
            'name_ind' => 'Shirt',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'option',
            'name' => 'Tie',
            'name_ind' => 'Tie',
            'description' => ''
        ]);

        DB::table('features')->insert([
            'category_id' => 1,
            'type' => 'value',
            'name' => 'Monogram',
            'name_ind' => 'Monogram',
            'description' => ''
        ]);
    }
}
