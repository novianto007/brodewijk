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
        $this->call('CustomerSeeder');
        $this->call('FeaturePriceSeeder');
        $this->call('ProductSeeder');
        $this->call('ProductFeatureSeeder');
        $this->call('StandardMeasurementSeeder');
        $this->call('DefaultMeasurementSeeder');
        $this->call('FitOptionSeeder');
        $this->call('ClothMeasurementSeeder');
        $this->call('PantsMeasurementSeeder');
        $this->call('SizePreferenceSeeder');
        $this->call('ProvinceSeeder');
        $this->call('CitySeeder');
        $this->call('DistrictSeeder');
        $this->call('CountrySeeder');
        $this->call('AddressSeeder');
        $this->call('PromoSeeder');
        $this->call('PromoRuleSeeder');
        $this->call('UserSeeder');
    }
}
