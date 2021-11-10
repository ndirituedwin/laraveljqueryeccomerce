<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederprodcts=[

   [

    'admin_id'=>2,
    'section_id'=>1,
    'brand_id'=>1,
    'category_id'=>1,
    'productname'=>'black levise jeans for men ',
    'slug'=>Str::slug('black levise jeans for men'),
    'productcode'=>'blv001',
    'productcolor'=>'black',
    'productprice'=>'700',
    'productdiscount'=>'10',
    'productweight'=>'10gms',
    'productimage'=>'null',
    'productdescription'=>'description men black  ',
    'washcare'=>'handwash',
      'fabric'=>'cotton',
      'pattern'=>'patterns',
      'sleeve'=>'no sleeve',
      'fit'=>'sixe',
      'occassion'=>'formal',
      'metattitle'=>'meta b title',
      'metadescription'=>'meta b description',
      'metakeyword'=>'product b metakeyword',
      'featured'=>1,
      'status'=>1,
   ],
   [
    'admin_id'=>1,
    'section_id'=>2,
    'brand_id'=>2,
    'category_id'=>2,
    'productname'=>'white levise jeans for men ',
    'slug'=>Str::slug('white levise jeans for men'),
    'productcode'=>'wl001',
    'productcolor'=>'wite',
    'productprice'=>'5000',
    'productdiscount'=>'10',
    'productweight'=>'1gms',
    'productimage'=>'nnn',
    'productdescription'=>'description men white  ',
    'washcare'=>'car wash',
      'fabric'=>'coton',
      'pattern'=>'paterns',
      'sleeve'=>' sleeve',
      'fit'=>'sie',
      'occassion'=>'not formal',
      'metattitle'=>'meta w title',
      'metadescription'=>'meta w description',
      'metakeyword'=>'product w metakeyword',
      'featured'=>1,
      'status'=>1,
   ],
   [
    'admin_id'=>2,
    'brand_id'=>3,
    'section_id'=>3,
    'category_id'=>2,
    'productname'=>'brown levise jeans for kids ',
    'slug'=>Str::slug('brown levise jeans for kids'),
    'productcode'=>'bl001',
    'productcolor'=>'brown',
    'productprice'=>'200',
    'productdiscount'=>'10',
    'productweight'=>'2gms',
    'productimage'=>'nnnn',
    'productdescription'=>'description men brown  ',
    'washcare'=>'was hand wash',
      'fabric'=>'cotton',
      'pattern'=>'paterns',
      'sleeve'=>' sleeve',
      'fit'=>'sie',
      'occassion'=>'not formal',
      'metattitle'=>'meta w title',
      'metadescription'=>'meta brown description',
      'metakeyword'=>'product w metakeyword',
      'featured'=>1,
      'status'=>1,
   ]

        ];
        foreach($seederprodcts as $seeder){
            Product::create($seeder);
        }
    }
}