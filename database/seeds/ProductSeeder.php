<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id' => 1,
            'fabric_id' => 1,
            'fabric_color_id' => 1,
            'name' => 'product 1',
            'description' => 'best suit product',
            'image' => 'https://images-na.ssl-images-amazon.com/images/I/61ErfIIKOmL._UL1440_.jpg',
            'is_default' => 1,
            'slug' => 'product-1'
        ]);
    }
}
