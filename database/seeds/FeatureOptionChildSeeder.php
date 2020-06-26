<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureOptionChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_option_childs')->insert([
            'feature_option_id' => 1,
            'name' => 'Black',
            'image' => 'https://www.brodewijk.com/static/media/Black.b0574060.jpg',
            'is_default' => 1,
            'resources' => null
        ]);

        DB::table('feature_option_childs')->insert([
            'feature_option_id' => 1,
            'name' => 'Navy Blue',
            'image' => 'https://www.brodewijk.com/static/media/Black.b0574060.jpg',
            'is_default' => 0,
            'resources' => null
        ]);

        DB::table('feature_option_childs')->insert([
            'feature_option_id' => 2,
            'name' => 'Black',
            'image' => 'https://www.brodewijk.com/static/media/Black.b0574060.jpg',
            'is_default' => 0,
            'resources' => null
        ]);

        DB::table('feature_option_childs')->insert([
            'feature_option_id' => 2,
            'name' => 'Navy Blue',
            'image' => 'https://www.brodewijk.com/static/media/Black.b0574060.jpg',
            'is_default' => 0,
            'resources' => null
        ]);
    }
}
