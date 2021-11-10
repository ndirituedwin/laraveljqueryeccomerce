<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prepaidpincode;

class prepaidseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prepaid=[
            [
                'pincode'=>121212
            ],
            [
                'pincode'=>454545
            ]
            ];
            foreach($prepaid as $p){
                Prepaidpincode::create($p);
            }
    }
}