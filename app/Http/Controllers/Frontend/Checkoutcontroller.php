<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Productattribute;
use App\Models\ShippingCharge;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Checkoutcontroller extends Controller
{
    public function checkout(){
   $getsections=Section::with('categories')->where('status',1)->get();
    $usercartitem=Cart::userCartItems();
   // dd($usercartitem);
    $deliveryaddress=DeliveryAddress::deliveryAddress();


    $totalprice=0;
    $totalweight=0;
    foreach ($usercartitem as $cartitem){
      $productweight=$cartitem['product']['productweight'];
    //dd($productweight);

      $totalweight=$totalweight+($productweight * $cartitem['quantity']);
      $productattributeprice=Product::getdiscountedattrprice($cartitem['product_id'],$cartitem['size']);
       $totalprice=$totalprice+( $productattributeprice['discounted_price'] * $cartitem['quantity'] );

    }
    //dd($totalweight);
    foreach($deliveryaddress as $key => $address){
      $shippingcharges=ShippingCharge::getshippingcharges($totalweight,$address['country']);
      $deliveryaddress[$key]['shipping_charges']=$shippingcharges;

      $deliveryaddress[$key]['codpincodecount']=DB::table('codpincodes')->where('pincode',$address['pincode'])->count();
      $deliveryaddress[$key]['prepaidpincodecount']=DB::table('prepaidpincodes')->where('pincode',$address['pincode'])->count();

    }
       //dd($deliveryaddress);
      if(count($usercartitem)==0){
      return back()->withdanger("shopping cart empty");
    }else{
    return view('Frontend.deliveyaddress.checkout')->withsections($getsections)
    ->withcartitems($usercartitem)->withtotalprice($totalprice)->withdeliveryaddress($deliveryaddress);
    }
  }
    public function checkoutpost(Request $request){

     $getsections=Section::with('categories')->where('status',1)->get();
     $usercartitem=Cart::userCartItems();
     $deliveryaddress=DeliveryAddress::deliveryAddress();


       $totalprice=0;
       $totalweight=0;
       foreach ($usercartitem as $cartitem){
        $productweight=$cartitem['product']['productweight'];
        $totalweight=$totalweight+ ($productweight * $cartitem['quantity'] );
       $productattributeprice=Product::getdiscountedattrprice($cartitem['product_id'],$cartitem['size']);
        $totalprice=$totalprice+( $productattributeprice['discounted_price'] * $cartitem['quantity'] );

     }
     foreach($deliveryaddress as $key => $address){
      $shippingcharges=ShippingCharge::getshippingcharges($totalweight,$address['country']);
      $deliveryaddress[$key]['shipping_charges']=$shippingcharges;

      //check if deliveryaddresspincode exists
      $deliveryaddress[$key]['codpincodecount']=DB::table('codpincodes')->where('pincode',$address['pincode'])->count();
      $deliveryaddress[$key]['prepaidpincodecount']=DB::table('prepaidpincodes')->where('pincode',$address['pincode'])->count();


    }


      //check if the product is disabled
      foreach($usercartitem as $key=>$cartitem){
        $productstatus=Product::checkproductstatus($cartitem['product_id']);
       // dd($productstatus);
         if($productstatus['status']==0){
           Product::deletecartitemifproductinactive($cartitem['product_id']);
           return back()->withinfo("Dear customer ".$productstatus['productname']." product is unavailable at the moment and so we have deleted it for you");

         }
         $checkoutofstock=Product::checkifoutofstockbeforeplacingorder($cartitem['product_id'],$cartitem['size']);

         if($checkoutofstock['stock']==0){
          Product::deletecartitemifproductinactive($cartitem['product_id']);
           $productname=Product::select('productname')->where('id',$checkoutofstock['product_id'])->first()->toArray();
          // return back()->withdanger($productname['productname']." is out of stock and so we have deleted it for you");
          return back();
         }
         //check if product attributeis disable
         $checkifinactive=Product::getproductattributecount($cartitem['product_id'],$cartitem['size']);

         if($checkifinactive==0){
          Product::deletecartitemifproductinactive($cartitem['product_id']);
           return back()->withdanger("product is un available");
         }
           //check if category is disabled
           $categorystatus=Product::getcategorystatus($cartitem['product']['category_id']);

           if($categorystatus['status']==0){
            Product::deletecartitemifproductinactive($cartitem['product_id']);
             return back()->withdanger("product not available");
           }
        }

      $this->validate($request, [
        'address_id'=>'required',
        'payment_gateway'=>'required',


        ]);

        if($request['payment_gateway']=="COD"){
          $paymentmethod="COD";
        }else{
          $paymentmethod="Prepaid";
        }
        DB::beginTransaction();
      //get delivery address details  from delivery address_id
     $deliveryaddressdetails=DeliveryAddress::where('id',$request['address_id'])->first()->toArray();
     $shippingcharge=ShippingCharge::getshippingcharges($totalweight,$deliveryaddressdetails['country']);
      $grandtotal=$totalprice+$shippingcharge-Session::get('couponamount');

      //put grand total in session
      Session::put('grandtotall',$grandtotal);

     Order::create([
            'user_id'=>Auth::user()->id,
            'name'=>$deliveryaddressdetails['name'],
            'address'=>$deliveryaddressdetails['address'],
            'city'=>$deliveryaddressdetails['city'],
            'state'=>$deliveryaddressdetails['state'],
            'country'=>$deliveryaddressdetails['country'],
            'pincode'=>$deliveryaddressdetails['pincode'],
            'mobile'=>$deliveryaddressdetails['mobile'],
            'email'=>Auth::user()->email,
            'shippingcharges'=>$shippingcharge,
            'couponcode'=>Session::get('couponcode'),
            'couponamount'=>Session::get('couponamount'),
            'orderstatus'=>'New',
            'courier_name'=>'',
            'tracking_number'=>'',
            'paymentmethod'=>$paymentmethod,
            'paymentgateway'=>$request['payment_gateway'],
            'grandtotal'=>Session::get('grandtotall'),

            ]);
            //getlastinserted id
            $orderid=DB::getPdo()->lastInsertId();
            $cartproducts=Cart::where('user_id',Auth::user()->id)->get()->toArray();
            foreach($cartproducts as $cartproduct){
              $orders=new OrdersProduct();
              $orders->user_id=Auth::user()->id;
              $orders->order_id=$orderid;
              $productdetails=Product::select('productcode','productname','productcolor')->where('id',$cartproduct['product_id'])->first()->toArray();
              $orders->product_id=$cartproduct['product_id'];
              $orders->product_code=$productdetails['productcode'];
              $orders->product_name=$productdetails['productname'];
              $orders->product_color=$productdetails['productcolor'];
              $orders->product_size=$cartproduct['size'];
              $productprice=Product::getdiscountedattrprice($cartproduct['product_id'],$cartproduct['size']);

              $orders->product_price=$productprice['discounted_price'];
              $orders->product_quantity=$cartproduct['quantity'];
              $orders->save();
              if($request['payment_gateway']=="COD"){
                //REDUCE THE STock size
                $getproductstock=Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['size']])->first()->toArray();
              //subtracting user quantity from the available stock quantity
              $newproductstockforthatsize=$getproductstock['stock'] - $cartproduct['quantity'];
              Productattribute::where(['product_id'=>$cartproduct['product_id'],'size'=>$cartproduct['size']])
              ->update([
                'stock'=>$newproductstockforthatsize,
              ]);

            }
            }
            //empty cart table
           Session::forget('couponamount');
            Session::put('order_id',$orderid);
            DB::commit();
          // dd("kj");
            if($request['payment_gateway']=="COD"){
                $message="Dear Customer, yor order ".$orderid."has been successfully placed with myamazoneccomerce.We shall inform ya once your order has been shipped";
              $mobile=Auth::user()->mobile;
              Sms::sendsms($message,$mobile);
              $orderdetails=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
              $userdetails=User::where('id',$orderdetails['user_id'])->first()->toArray();
            //   dd($orderdetails);
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
                  $message->to($email)->subject('Order placed to Programming techie');
                });
                return redirect()->route('CODthanks.page');
              } catch (\Throwable $th) {
                   return back()->withdanger("failed: ".$th);
              }


            }else if($request['payment_gateway']=="Paypal"){
              return redirect()->route('paypal.show');
              //dd("paypa");
            }else if($request['payment_gateway']=="lipanampesa"){
            //  dd($request['payment_gateway']);
             //redirect to lipa na mpesa page
             return redirect()->route('lipa.nampesa');

            }

        //    Session::delete('couponcode');

    }
    public function thankspage(){
      if(Session::has('order_id')){
         Cart::where('user_id',Auth::user()->id)->delete();
      $getsections=Section::with('categories')->where('status',1)->get();
      return view('Frontend.deliveyaddress.thankspage')->withsections($getsections)->withsuccess('Order successfully placed');
      }
      return redirect()->route('frontend.index');
         }
    public function deliveryaddress(){
        $getsections=Section::with('categories')->where('status',1)->get();
        $de=DeliveryAddress::with('country')->where('status',1)->get()->toArray();
      //  dd($de);
        $countries=Country::where('status',1)->get()->toArray();
       // dd($countries);
        return view('Frontend.deliveyaddress.adddeliveryaddress')->withsections($getsections)->withcountries($countries);
    }
    public function deliveryaddressadd(Request $request){
    // dd($request);
     $this->validate($request, [
        'name'=>'required|regex:/^[\pL\s\-]+$/u',
        'address'=>'required',
        'state'=>'required|regex:/^[\pL\s\-]+$/u',
        'city'=>'required|regex:/^[\pL\s\-]+$/u',
        'country'=>'required',
        'pincode'=>'required|numeric|digits:6',
        'mobile'=>'required|numeric|digits:10',

    ]);

    //dd($request);
    DeliveryAddress::create([
        'user_id'=>Auth::user()->id,
        'name'=>$request->name,
        'address'=>$request->address,
        'state'=>$request->state,
        'city'=>$request->city,
        'country'=>$request->country,
        'pincode'=>$request->pincode,
        'mobile'=>$request->mobile,
          'status'=>1
       ]);
       return redirect()->route('checkout.page')->withsuccess('Delivery address added successfully');
   // return back()->withsuccess('Delivery addre successfully updated');
    }
    public function deliveryaddressedit($id){
    $getdeliveryaddress=DeliveryAddress::find($id);
  //  dd($getdeliveryaddress);
  $countries=Country::where('status',1)->get()->toArray();
  $getsections=Section::with('categories')->where('status',1)->get();

        return view('Frontend.deliveyaddress.editdeliveryaddress')
        ->withcountries($countries)
        ->withsections($getsections)
        ->withdeliveryaddress($getdeliveryaddress);

    }

    public function deliveryaddresspostedit(Request $request,$id){
       // dd(Auth::user());
        $this->validate($request, [
            'name'=>'required|regex:/^[\pL\s\-]+$/u',
           'address'=>'required',
           'state'=>'required|regex:/^[\pL\s\-]+$/u',
           'city'=>'required|regex:/^[\pL\s\-]+$/u',
            'country'=>'required',
            'pincode'=>'required|numeric|digits:6',
            'mobile'=>'required|numeric|digits:10',

        ]);
        $user=DeliveryAddress::Where('id',$id)->first();
        //dd($user->user_id);
        if($user->user_id != Auth::user()->id){
           abort(404);
        }
        DeliveryAddress::where('id',$id)->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->name,
            'address'=>$request->address,
            'state'=>$request->state,
            'city'=>$request->city,
            'country'=>$request->country,
            'pincode'=>$request->pincode,
            'mobile'=>$request->mobile,
              'status'=>1
        ]);
        return redirect()->route('checkout.page')->withsuccess('Delivery address updated successfully');

    }
    public function deliveryaddressdelete($id){
        $user=DeliveryAddress::Where('id',$id)->first();
        if($user->user_id != Auth::user()->id){
          abort(404);
        }
        DeliveryAddress::find($id)->delete();
        return back()->withinfo('delivery address deleted');

    }

}