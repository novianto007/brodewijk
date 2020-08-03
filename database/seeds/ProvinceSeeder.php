<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert(['id' => 11, 'name' => 'Aceh']);
        DB::table('provinces')->insert(['id' => 12, 'name' => 'Sumatera Utara']);
        DB::table('provinces')->insert(['id' => 13, 'name' => 'Sumatera Barat']);
        DB::table('provinces')->insert(['id' => 14, 'name' => 'Riau']);
        DB::table('provinces')->insert(['id' => 15, 'name' => 'Jambi']);
        DB::table('provinces')->insert(['id' => 16, 'name' => 'Sumatera Selatan']);
        DB::table('provinces')->insert(['id' => 17, 'name' => 'Bengkulu']);
        DB::table('provinces')->insert(['id' => 18, 'name' => 'Lampung']);
        DB::table('provinces')->insert(['id' => 19, 'name' => 'Kepulauan Bangka Belitung']);
        DB::table('provinces')->insert(['id' => 21, 'name' => 'Kepulauan Riau']);
        DB::table('provinces')->insert(['id' => 31, 'name' => 'DKI Jakarta']);
        DB::table('provinces')->insert(['id' => 32, 'name' => 'Jawa Barat']);
        DB::table('provinces')->insert(['id' => 33, 'name' => 'Jawa Tengah']);
        DB::table('provinces')->insert(['id' => 34, 'name' => 'DI Yogyakarta']);
        DB::table('provinces')->insert(['id' => 35, 'name' => 'Jawa Timur']);
        DB::table('provinces')->insert(['id' => 36, 'name' => 'Banten']);
        DB::table('provinces')->insert(['id' => 51, 'name' => 'Bali']);
        DB::table('provinces')->insert(['id' => 52, 'name' => 'Nusa Tenggara Barat']);
        DB::table('provinces')->insert(['id' => 53, 'name' => 'Nusa Tenggara Timur']);
        DB::table('provinces')->insert(['id' => 61, 'name' => 'Kalimantan Barat']);
        DB::table('provinces')->insert(['id' => 62, 'name' => 'Kalimantan Tengah']);
        DB::table('provinces')->insert(['id' => 63, 'name' => 'Kalimantan Selatan']);
        DB::table('provinces')->insert(['id' => 64, 'name' => 'Kalimantan Timur']);
        DB::table('provinces')->insert(['id' => 65, 'name' => 'Kalimantan Utara']);
        DB::table('provinces')->insert(['id' => 71, 'name' => 'Sulawesi Utara']);
        DB::table('provinces')->insert(['id' => 72, 'name' => 'Sulawesi Tengah']);
        DB::table('provinces')->insert(['id' => 73, 'name' => 'Sulawesi Selatan']);
        DB::table('provinces')->insert(['id' => 74, 'name' => 'Sulawesi Tenggara']);
        DB::table('provinces')->insert(['id' => 75, 'name' => 'Gorontalo']);
        DB::table('provinces')->insert(['id' => 76, 'name' => 'Sulawesi Barat']);
        DB::table('provinces')->insert(['id' => 81, 'name' => 'Maluku']);
        DB::table('provinces')->insert(['id' => 82, 'name' => 'Maluku Utara']);
        DB::table('provinces')->insert(['id' => 91, 'name' => 'Papua Barat']);
        DB::table('provinces')->insert(['id' => 92, 'name' => 'Papua']);
    }
}
