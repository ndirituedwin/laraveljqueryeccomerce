<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
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
        'status',
    ];
    public static function  deliveryAddress(){

        $user_id=Auth::user()->id;
        $deliveryaddress=DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $deliveryaddress;

    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

}
