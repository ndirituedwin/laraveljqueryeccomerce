<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BannersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $bannerscreate=[
              [
                'image'=>'1.png',
                'title'=>'Black jacket ',
                'slug'=>Str::slug('jacket banner'),
                'link'=>'',
                'alt'=>'jacket banner',
                'status'=>1,
              ],
              [
                'image'=>'2.png',
                'title'=>'Half sleeve T shirt',
                'slug'=>Str::slug('Half sleeve T shirt'),
                'link'=>'',
                'alt'=>'t shirt half sleeve',
                'status'=>1,
              ],
              [
                'image'=>'3.png',
                'title'=>'Full sleeve t shirt',
                'slug'=>Str::slug('Full sleeve t shirt'),
                'link'=>'',
                'alt'=>'Full sleeve',
                'status'=>1,
              ],
          ];
          foreach($bannerscreate as $createbanner){
              Banner::create($createbanner);
          }
    }
}
