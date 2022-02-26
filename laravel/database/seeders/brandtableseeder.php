<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class brandtableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandtableseeder=[
            [
                  'brand'=>'levis',
                  'status'=>1
            ],
            [
                'brand'=>'polo',
                'status'=>1
          ],
          [
            'brand'=>'Nike',
            'status'=>1
      ],
      
        ];
        foreach($brandtableseeder as $bran){
                   Brand::create($bran);
        }
    }
}
