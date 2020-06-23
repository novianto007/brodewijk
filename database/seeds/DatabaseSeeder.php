<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ProductSeeder');
        $this->call('FabricTypeSeeder');
        $this->call('FabricSeeder');
        $this->call('FabricColorSeeder');
        $this->call('FeatureSeeder');
        $this->call('FeatureOptionSeeder');
        $this->call('FeatureOptionChildSeeder');
    }
}
