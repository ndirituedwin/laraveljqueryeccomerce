<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class Orderstatusesseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatus=[
           [
            'name'=>'New',
            'status'=>1,
           ],
           [
            'name'=>'pending',
            'status'=>1,
           ],

           [
            'name'=>'Hold',
            'status'=>1,
           ],
           [
            'name'=>'Cancelled',
            'status'=>1,
           ],
           [
            'name'=>'In process',
            'status'=>1,
           ],
           [
            'name'=>'Paid',
            'status'=>1,
           ],
           [
            'name'=>'Shipped',
            'status'=>1,
           ],
           [
            'name'=>'Delivered',
            'status'=>1,
           ],

        ];
        foreach($orderStatus as $order){
            OrderStatus::create($order);
        }
    }
}
