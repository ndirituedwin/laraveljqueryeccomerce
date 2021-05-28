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
    $deliveryaddress=DeliveryAddress:: deliveryAddress();
    return view('Frontend.deliveyaddress.checkout')->withsections($getsections)
    ->withcartitems($usercartitem)->withdeliveryaddress($deliveryaddress);
    }
    public function checkoutpost(Request $request){
     // dd(Session::get('couponamount'));
      $this->validate($request, [
        'address_id'=>'required',
        'payment_gateway'=>'required',
            
            
        ]);
        //dd("v");
        if($request['payment_gateway']=="COD"){
          $paymentmethod="COD";
        }else{
          $paymentmethod="Prepaid";
        }
        DB::beginTransaction();
      //get delivery address details  from delivery address_id
     $deliveryaddressdetails=DeliveryAddress::where('id',$request['address_id'])->first()->toArray();
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
            'shippingcharges'=>0,
            'couponcode'=>Session::get('couponcode'),
            'couponamount'=>Session::get('couponamount'),
            'orderstatus'=>'New',
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
            }
            //empty cart table
           Session::forget('couponamount');
            Session::put('order_id',$orderid);
            DB::commit();

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
                'first_name'=>Auth::user()->first_name,
                'last_name'=>Auth::user()->last_name,
                'order_id'=>$orderid,
                'orderdetails'=>$orderdetails,
                'userdetails'=>$userdetails,
              ];
              Mail::send('Frontend.emails.placeorderemail',$messagedata,function($message) use($email){
                $message->to($email)->subject('Order placed my amazon.com');
              });
              return redirect()->route('CODthanks.page');

            }else{
              dd("prepaid coming soon");
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
