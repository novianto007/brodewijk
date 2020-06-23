<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabric_colors')->insert([
            'fabric_id' => 1,
            'name' => 'Navy Blue',
            'image' => 'https://www.brodewijk.com/static/media/Navy%20Blue.f4f7dda4.jpg',
            'code' => '7',
            'path' => '',
        ]);

        DB::table('fabric_colors')->insert([
            'fabric_id' => 2,
            'name' => 'Super Black',
            'image' => 'https://www.brodewijk.com/static/media/Super%20Black.ed3ba333.jpg',
            'code' => null,
            'path' => '',
        ]);
    }
}
