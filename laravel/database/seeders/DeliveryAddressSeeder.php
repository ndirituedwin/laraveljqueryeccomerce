<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableseeder=[
            [
                'user_id'=>1,
                'name'=>'edwin ndiritu',
                'address'=>'makongeni',
                'city'=>'thika',
                'state'=>'makongeni',
                'country'=>'kenya',
                'pincode'=>'001',
                'mobile'=>'0799149758',
                'status'=>1
            ],
            [
                'user_id'=>2,
                'name'=>'apollo ndiritu',
                'address'=>'makongeni',
                'city'=>'nyeri',
                'state'=>'gatitu',
                'country'=>'kenya',
                'pincode'=>'002',
                'mobile'=>'0799149778',
                'status'=>1
            ]
        ];
        foreach($tableseeder as $seed){
            DeliveryAddress::create($seed);
        }
    }
}
