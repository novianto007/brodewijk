<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_options')->insert([
            'feature_id' => 1,
            'name' => 'Standard',
            'image' => null,
            'is_has_child' => 1,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null, 
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 1,
            'name' => '❆ Bemberg',
            'image' => null,
            'is_has_child' => 1,
            'description' => '<b style="font-weight: 600;">Premium Silk</b>, Cooler, Thermal Comfort, Softer on Your Skin.',
            'description_ind' => 'Sutra Premium, Lebih Dingin, Kenyamanan Termal, Lebih Lembut di Kulit Anda.',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 2,
            'name' => 'Unconstructed',
            'image' => 'https://www.brodewijk.com/static/media/construction_unconstructed.2d1b4e1b.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 2,
            'name' => 'Full Canvas',
            'image' => 'https://www.brodewijk.com/static/media/construction_full_canvas.df3370de.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);
        
        DB::table('feature_options')->insert([
            'feature_id' => 3,
            'name' => 'Standard',
            'image' => 'https://www.brodewijk.com/static/media/construction_full_canvas.df3370de.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 3,
            'name' => 'Roped',
            'image' => 'https://www.brodewijk.com/static/media/construction_full_canvas.df3370de.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 4,
            'name' => 'Notch',
            'image' => 'https://www.brodewijk.com/static/media/notch.50b57eff.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => 'lapel_medium+style_lapel_notch',
            'resource_depend' => 6,
            'resources' => 'a:1:{s:4:"neck";s:48:"neck_{depend}+lapel_medium+style_lapel_notch.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 4,
            'name' => 'Notch Slim',
            'image' => 'https://www.brodewijk.com/static/media/notch_wide.323b6a18.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => 'lapel_slim+style_lapel_notch',
            'resource_depend' => 6,
            'resources' => 'a:1:{s:4:"neck";s:46:"neck_{depend}+lapel_slim+style_lapel_notch.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 5,
            'name' => 'Welted',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_welted.504a0333.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => 'a:1:{s:6:"pocket";s:25:"breast_pocket_classic.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 5,
            'name' => 'Round Patched',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_round_patch.a8f98475.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => 'a:1:{s:6:"pocket";s:25:"breast_pocket_patched.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 6,
            'name' => 'One',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_welted.504a0333.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => 'single_breasted+buttons_1',
            'resource_depend' => 4,
            'resources' => 'a:1:{s:4:"neck";s:43:"neck_single_breasted+buttons_1+{depend}.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 6,
            'name' => 'Four Buttons Double Breasted',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_welted.504a0333.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => 'double_breasted+buttons_4',
            'resource_depend' => 4,
            'resources' => 'a:1:{s:4:"neck";s:43:"neck_double_breasted+buttons_4+{depend}.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 7,
            'name' => 'No Pocket Flaps',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_welted.504a0333.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => 'a:1:{s:6:"pocket";s:36:"hip_pockets_double_welt+fit_slim.png";}'
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 7,
            'name' => 'Pocket Flaps',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_round_patch.a8f98475.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => 'a:1:{s:6:"pocket";s:34:"hip_pockets_with_flap+fit_slim.png";}'
        ]);
        
        DB::table('feature_options')->insert([
            'feature_id' => 8,
            'name' => 'One',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_welted.504a0333.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 8,
            'name' => 'Two',
            'image' => 'https://www.brodewijk.com/static/media/chest_pocket_round_patch.a8f98475.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 9,
            'name' => 'Without Pants',
            'image' => 'https://www.brodewijk.com/static/media/none.862eca24.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 9,
            'name' => 'With Pants',
            'image' => 'https://www.brodewijk.com/static/media/pants.abf12d1b.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 10,
            'name' => 'Without Vest',
            'image' => 'https://www.brodewijk.com/static/media/none.862eca24.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 10,
            'name' => 'With Vest',
            'image' => 'https://www.brodewijk.com/static/media/vest.3e8b1059.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 11,
            'name' => 'Without Shirt',
            'image' => 'https://www.brodewijk.com/static/media/none.862eca24.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 11,
            'name' => 'With Shirt',
            'image' => 'https://www.brodewijk.com/static/media/shirt.259f50e2.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 12,
            'name' => 'None',
            'image' => 'https://www.brodewijk.com/static/media/none.862eca24.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 12,
            'name' => 'Bow Tie',
            'image' => 'https://www.brodewijk.com/static/media/bowtie.4e29894b.png',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 13,
            'name' => 'none',
            'image' => '',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);

        DB::table('feature_options')->insert([
            'feature_id' => 13,
            'name' => 'add',
            'image' => '',
            'is_has_child' => 0,
            'description' => '',
            'description_ind' => '',
            'code_name' => null,
            'resource_depend' => null,
            'resources' => null
        ]);
    }
}
