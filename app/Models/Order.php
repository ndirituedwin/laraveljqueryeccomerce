<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
   protected $fillable=[

    'user_id',
    'name',
    'address',
    'city',
    'state',
    'country',
    'pincode',
    'mobile',
    'email',
    'shippingcharges',
    'couponcode',
    'couponamount',
    'orderstatus',
    'paymentmethod',
    'paymentgateway',
    'grandtotal'
   ];
   public function orders_products(){
       return $this->hasMany(OrdersProduct::class);
   }
}
