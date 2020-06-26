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
        $this->call('CategorySeeder');
        $this->call('FabricTypeSeeder');
        $this->call('FabricSeeder');
        $this->call('FabricColorSeeder');
        $this->call('FeatureSeeder');
        $this->call('FeatureOptionSeeder');
        $this->call('FeatureOptionChildSeeder');
        $this->call('FeaturePrice');
        $this->call('Product');
        $this->call('ProductFeature');
    }
}
