<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCharge extends Model
{
    use HasFactory;
    //  protected $dates=['deleted_at'];
    protected $fillable=[
        'country_name',
        'country_code',
        'shipping_charges',
         'status'
     ];
      public static function  getshippingcharges($totalweight,$country){
        $shippingdetails=ShippingCharge::where('country_name',$country)->first()->toArray();
        //$shippingcharges=$shippingdetails['shipping_charges'];
           if($totalweight>0){
                if($totalweight>0 && $totalweight <=500){
                  $shippingcharges=$shippingdetails['zero_500g'];
                }elseif($totalweight>501 && $totalweight <=1000){
                  $shippingcharges=$shippingdetails['fivezeroone_1000g'];

                }elseif($totalweight>1001 && $totalweight <=2000){
                  $shippingcharges=$shippingdetails['onezerozeroone_2000g'];

                }elseif($totalweight>2001 && $totalweight <=5000){
                  $shippingcharges=$shippingdetails['twozerozeroone_5000g'];

                }elseif($totalweight>5000){
                  $shippingcharges=$shippingdetails['above_5000g'];

                }else{
                  $shippingcharges=0;
                }
           }else{
             $shippingcharges=0;
           }

        return $shippingcharges;
      }

}
