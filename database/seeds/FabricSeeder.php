<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabrics')->insert([
            'fabric_type_id' => 1,
            'name' => 'Hagebridge Wool',
            'brand' => 'Gino Ferucci',
            'grade' => 'Super 200s Wool',
            'description' => 'Cool in Summer, Warm in Winter, Easy to maintain, Wrinkle Free; Best for Wedding, Business, Party, Graduation',
            'description_ind' => 'Sejuk di Musim Panas, Hangat di Musim Dingin, Mudah dirawat, Bebas Kerut; Terbaik untuk Pernikahan, Bisnis, Pesta, Wisuda'
        ]);

        DB::table('fabrics')->insert([
            'fabric_type_id' => 2,
            'name' => 'Vanelli',
            'brand' => 'Giovanelli Biella Tuxedo Italy',
            'grade' => 'Super 200s Wool',
            'description' => 'Solid Colour, Warmer, Easy to maintain, Wrinkle Free; Best for Wedding, Business, Party, Graduation',
            'description_ind' => 'Warna Solid, Hangat, Mudah dirawat, Bebas Kerut; Terbaik untuk Pernikahan, Bisnis, Pesta, Wisuda'
        ]);
    }
}
