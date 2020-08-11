<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promo_rules')->insert([
            'promo_id' => 1,
            'type' => 'min',
            'value' => '1781945',
        ]);

        DB::table('promo_rules')->insert([
            'promo_id' => 1,
            'type' => 'start_at',
            'value' => '2020-08-15 00:00:00',
        ]);

        DB::table('promo_rules')->insert([
            'promo_id' => 1,
            'type' => 'end_at',
            'value' => '2020-08-19 00:00:00',
        ]);

        DB::table('promo_rules')->insert([
            'promo_id' => 1,
            'type' => 'fabric',
            'value' => 'a:1:{i:0;i:1;}',
        ]);
    }
}
