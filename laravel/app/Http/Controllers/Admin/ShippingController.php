<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
  function shippingcharges(){
    Session::put('page','shipping');
     
    //  dd("s");
      $shippingcharges=ShippingCharge::get()->toArray();
     //dd($shippingcharges);

     return view('admin.shippingcharges.fetchallshippingcharges')->withshippingcharges($shippingcharges);
  }   
  function shippingchargesedit($shippingid){
   // dd($shippingid);
               $singleshippingcharge=ShippingCharge::where('id',$shippingid)->first()->toArray();
               return view('admin.shippingcharges.editshipping')->withshipping($singleshippingcharge);
               
                   dd($singleshippingcharge);
  }
  function addshippingcharges(Request $request,$shipping){
      // dd($request);
  //  dd($shipping);
    $this->validate($request,[
      'country'=>'required',
      'zero_500g'=>'required',
      'fivezeroone_1000g'=>'required',
      'onezerozeroone_2000g'=>'required',
      'twozerozeroone_5000g'=>'required',
      'above_5000g'=>'required',
    ]);
  //  dd($request);
    // dd($request['country']);
     if( ShippingCharge::where('id',$shipping)->update(
       [
         'country_name'=>$request['country'],
        'zero_500g'=>$request['zero_500g'],
        'fivezeroone_1000g'=>$request['fivezeroone_1000g'],
        'onezerozeroone_2000g'=>$request['onezerozeroone_2000g'],
        'twozerozeroone_5000g'=>$request['twozerozeroone_5000g'],
        'above_5000g'=>$request['above_5000g'],
       
       ]
       
       )){
         return redirect()->route('admin.shipping')->withsuccess('shipping charges for country '.$request['country'].' successfully updated');
     }
     return back()->Withdanger("shipping charges failed to update");

  }
  public function updateshippingstatus(Request $request){
    if($request->ajax()){
        //  echo"<prev>";print_r($request->status);die;
          if($request->status=="Active"){
              $status=0;
          }else{
              $status=1;
          }
          ShippingCharge::where('id',$request->shipping_id)->update(['status'=>$status]);
          return response()->json(['status'=>$status,'shipping_id'=>$request['shipping_id']]);
  
      }
}
//   public function updateshippingstatus(Request $request){
//     if ($request->ajax()) {
//         // echo"<prev>";print_r($request->shipping_id);die;
//         if ($request->status=="Active") {
//             $status=0;
//         } else {
//             $status=1;
//         }
//         ShippingCharge::where('id', $request->shipping_id)->update(['status'=>$status]);
//         echo"<prev>";print_r($request->status);die;
//         return response()->json(['status'=>$status,'shipping_id'=>$request['shipping_id']]);
//     }
// }
}