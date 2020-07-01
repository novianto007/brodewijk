<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'username' => 'buyer',
            'email' => 'buyer@mail.com',
            'first_name' => 'the',
            'last_name' => 'buyer',
            'password' => app('hash')->make('MySecret'),
            'phone_number' => '08989999',
            'token' => null
        ]);
    }
}
