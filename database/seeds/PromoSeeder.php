<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promos')->insert([
            'name' => 'Promo spesial HUT RI',
            'description' => 'Dapatkan promo spesial HUT RI untuk setiap minimal pembelian 1781945',
            'code' => 'Merdeka75',
            'type' => 'discount',
            'amount' => 17,
            'is_active' => 1
        ]);
    }
}
