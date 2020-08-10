<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'staff',
            'username' => 'staff',
            'password' => app('hash')->make('MySecret'),
            'role' => 'staff'
        ]);

        DB::table('users')->insert([
            'name' => 'tailor',
            'username' => 'tailor',
            'password' => app('hash')->make('MySecret'),
            'role' => 'tailor'
        ]);
    }
}
