<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cateforyrecords=[
   
           [ 'parent_id'=>0,
            'section_id'=>1,
            'categoryname'=>'T shirts',
            'slug'=>Str::slug('T-shirts'),
            'categoryimage'=>'null',
            'categorydiscount'=>0.12,
            'description'=>'T shirts for men',
            'url'=>'tshirst',
            'metatitle'=>'t shirts meta title',
            'metadescription'=>'t shirts meta description',
            'metakeywords'=>'t shirts meta description',
            'status'=>1,
        ],
        [ 'parent_id'=>0,
        'section_id'=>2,
        'categoryname'=>'women T shirts',
        'slug'=>Str::slug('women T shirts'),
        'categoryimage'=>'null',
        'categorydiscount'=>0.55,
        'description'=>'T shirts for women',
        'url'=>'wtshirst',
        'metatitle'=>'women t shirts meta title',
        'metadescription'=>'women t shirts meta description',
        'metakeywords'=>'women t shirts meta description',
        'status'=>1,
    ],

        ];
        foreach($cateforyrecords as $cat){
                 Category::create($cat);
        }
      
    }
}
