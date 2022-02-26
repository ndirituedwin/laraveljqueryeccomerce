<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Codpincode;

class codseeder extends Seeder
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
                'pincode'=>222222
            ],
            [
                'pincode'=>777777
            ]
            ];
            foreach($prepaid as $p){
                Codpincode::create($p);
            }
    }
}