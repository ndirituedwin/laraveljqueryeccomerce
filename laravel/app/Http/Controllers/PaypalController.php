<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Section;
use App\Models\OrdersLog;
use Illuminate\Http\Request;
use App\Models\Productattribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    public function paypal(){
       // dd(Session::get('grandtotall')/108);
        if(Session::has('order_id')){
        //Cart::where('user_id',Auth::user()->id)->delete();
         $getsections=Section::with('categories')->where('status',1)->get();
         $orderdetails=Order::where('id',Session::get('order_id'))->first()->toArray();
        //  $fullnamearray=explode(' ',$orderdetails['name']);
        //  if(!empty($fullnamearray[0])){
        //     $firstname=$fullnamearray[0];
        //  }
         
        // dd($orderdetails);
        // dd($orderdetails);
         return view('Frontend.deliveyaddress.paypal.paypalthankspage')
         ->withorderdetails($orderdetails)
         //->withfullname($fullname)
         ->withsections($getsections)->withsuccess('Order successfully placed');
         }
         return redirect()->route('frontend.index');
            }

       function paypalsuccess(){
         if(Session::has('order_id')){
            $getsections=Section::with('categories')->where('status',1)->get();
            Cart::where('user_id',Auth::user()->id)->delete();
            $orderid=Session::get('order_id');
           // dd($orderid);
            $orderdetails=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
          //  dd($orderdetails);
            $userdetails=User::where('id',$orderdetails['user_id'])->first()->toArray();
            //dd($userdetails);
           // dd(Order::all()->toArray());
            
            Order::where('id',$orderid)->update(
              ['orderstatus'=>'Paid']);
             //  OrdersLog::where('order_id',$orderid)->update(['orderstatus','Paid']);
             // dd($orderdetails)
 //            dd($orderdetails['orders_products']);
             foreach($orderdetails['orders_products'] as $cartproduct){
              $getproductstock=Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['product_size']])->first()->toArray();
              //subtracting user quantity from the available stock quantity
              $newproductstockforthatsize=$getproductstock['stock'] - $cartproduct['product_quantity'];
              Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['product_size']])
              ->update([
                'stock'=>$newproductstockforthatsize,
              ]);
             }
               $email=Auth::user()->email;
               $messagedata=[
                 'email'=>$email,
                 'first_name'=>Auth::user()->first_name." ".Auth::user()->last_name,
                 'last_name'=>Auth::user()->last_name,
                 'order_id'=>$orderid,
                 'orderdetails'=>$orderdetails,
                 'userdetails'=>$userdetails,
               ];
               try {
                 Mail::send('Frontend.emails.placeorderemail',$messagedata,function($message) use($email){
                   $message->to($email)->subject('payment placed to Programming techie');
                 });
                // return redirect()->route('CODthanks.page');
                return view('Frontend.deliveyaddress.paypal.paypalsuccess')->withsections($getsections);
               // return redirect()->route('paypal.success')->withsections($getsections());
               } catch (\Throwable $th) {
                    return back()->withdanger("failed: ".$th);
               }

           // return view('Frontend.deliveyaddress.paypal.paypalsuccess')->withsections($getsections);
         }
       }   
       function paypalfailure(){
                $getsections=Section::with('categories')->where('status',1)->get();
                return view('Frontend.deliveyaddress.paypal.paypalfailure')->withsections($getsections);
             
       }  

       function paypalipnurl(Request $request){
          dd($request->all());
       // dd(Session::get('order_id'));
          $request['payment_status']=="Completed";
        //  $ipndata=json_decode(json_encode($request->all()));
          if($request['payment_status']=="Completed"){
             //process the order
             $orderid=Session::get('order_id');


          $orderdetails=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
          $userdetails=User::where('id',$orderdetails['user_id'])->first()->toArray();
             Order::where('order_id',$orderid)->update(['orderstatus','Paid']);
           //  OrdersLog::where('order_id',$orderid)->update(['orderstatus','Paid']);

           foreach($orderdetails['order_products'] as $cartproduct){
            $getproductstock=Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['size']])->first()->toArray();
            //subtracting user quantity from the available stock quantity
            $newproductstockforthatsize=$getproductstock['stock'] - $cartproduct['quantity'];
            Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['size']])
            ->update([
              'stock'=>$newproductstockforthatsize,
            ]);
           }
             $email=Auth::user()->email;
             $messagedata=[
               'email'=>$email,
               'first_name'=>Auth::user()->first_name." ".Auth::user()->last_name,
               'last_name'=>Auth::user()->last_name,
               'order_id'=>$orderid,
               'orderdetails'=>$orderdetails,
               'userdetails'=>$userdetails,
             ];
             try {
               Mail::send('Frontend.emails.placeorderemail',$messagedata,function($message) use($email){
                 $message->to($email)->subject('payment placed to Programming techie');
               });
               return redirect()->route('CODthanks.page');
             } catch (\Throwable $th) {
                  return back()->withdanger("failed: ".$th);
             }

          }
       }
    
   
}
