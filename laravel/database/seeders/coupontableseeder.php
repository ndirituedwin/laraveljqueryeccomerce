<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class coupontableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couporecords=[
            [
                'couponoption'=>'manual',
                'couponcode'=>'test10',
                'categories'=>'1,2',
                'users'=>'ndiritu.edwin018@gmail.com',
                'coupontype'=>'single',
                'amounttype'=>'percentage',
                'amount'=>'10',
                'expirydate'=>'2012-12-31',
                'status'=>1
            ],
        ];
        foreach($couporecords as $coup){
            Coupon::create($coup);
        }
    }
}
