<?php

namespace Database\Seeders;

use App\Models\Productattribute;
use Illuminate\Database\Seeder;

class Productattributetableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributessedr=[
            [
                'product_id'=>1,
                'size'=>'small',
                'price'=>100,
                'stock'=>10,
                'sku'=>'BMT001',
                'status'=>1
            ],
            [
                'product_id'=>2,
                'size'=>'small',
                'price'=>200,
                'stock'=>30,
                'sku'=>'CTW001',
                'status'=>1
            ],
            [
                'product_id'=>3,
                'size'=>'small',
                'price'=>500,
                'stock'=>50,
                'sku'=>'KT001',
                'status'=>1
            ],

        ];
        foreach($attributessedr as $att){
            Productattribute::create($att);
        }
    }
}
