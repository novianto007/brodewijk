<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Suit',
            'type' => 'suit',
            'resources' => 'a:3:{s:6:"bottom";s:53:"bottom_single_breasted+length_long+hemline_closed.png";s:4:"neck";s:65:"neck_single_breasted+buttons_1+lapel_narrow+style_lapel_notch.png";s:7:"sleeves";s:20:"interior+sleeves.png";}',
            'slug' => 'suit'
        ]);
    }
}
