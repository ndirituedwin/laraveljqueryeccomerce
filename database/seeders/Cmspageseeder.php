<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Cmspage;

class Cmspageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedcms=[
          [
              'admin_id'=>1,
            'title'=>'About us',
            'description'=>'About us Content coming soon',
            'slug'=>Str::slug('About us'),
            'meta_title'=>'About us meta title',
            'meta_description'=>'About us meta description',
            'meta_keyword'=>'About us meta keyword',
            'status'=>1
          ],
          [
            'admin_id'=>1,
          'title'=>'Privacy policy',
          'description'=>'Privacy policy Content coming soon',
          'slug'=>Str::slug('Privacy policy'),
          'meta_title'=>'Privacy policy meta title',
          'meta_description'=>'Privacy policy meta description',
          'meta_keyword'=>'Privacy policy meta keyword',
          'status'=>1,
        ]
        ];
        foreach ($seedcms as $key => $seed) {
            Cmspage::create($seed);
        }
    }
}
