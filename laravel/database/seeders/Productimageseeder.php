<?php

namespace Database\Seeders;

use App\Models\Productimage;
use Illuminate\Database\Seeder;

class Productimageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productimageseed=[
            [
                'product_id'=>1,
                'image'=>'default.png',
                'status'=>1,
            ],
            [
                'product_id'=>2,
                'image'=>'ggg.png',
                'status'=>1,
            ],
            [
                'product_id'=>3,
                'image'=>'fi.png',
                'status'=>1,
            ],

        ];
        foreach($productimageseed as $seed){
            Productimage::create($seed);
        }
    }
}
