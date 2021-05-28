<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Productattribute;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addproducttocart(Request $request){
              $doesstockexist=Productattribute::where(['product_id'=>$request['productid'],'size'=>$request['size']])->first()->toArray();
                $available=$doesstockexist['stock']; 
                if($request['quantity'] > $available){
                    return back()->withdanger('quantity may not be greater than there is available '.$doesstockexist['stock']);
                } 
              $session_id=Session::get('session_id');
              if(empty($session_id)){
                  $session_id=Session::getId();
                  Session::put('session_id',$session_id);
              } 
           /*   $cartcount=Cart::where(['product_id'=>$request['productid'],'size'=>$request['size']])->count();
              if($cartcount>0){
                  return back()->withdanger('cart item already exists');
              }*/


            if(Auth::check()){
                $cartcount=Cart::where(['product_id'=>$request['productid'],'size'=>$request['size'],'user_id'=>Auth::user()->id])->count();
                 
            }else{
                $cartcount=Cart::where(['product_id'=>$request['productid'],'size'=>$request['size'],'session_id'=>Session::get('session_id')])->count();
 
            }
            if($cartcount>0){
                return back()->withdanger('cart item already exists');

            }
            if(Auth::check()){
                $user_id=Auth::user()->id;
            }else{
                $user_id=0;
            }




              Cart::create(
                  [
                    'session_id'=>$session_id,
                    'user_id'=>$user_id,
                    'product_id'=>$request['productid'],
                      'size'=>$request['size'],
                      'quantity'=>$request['quantity']
                  ]);
               return redirect()->route('cart.show')->withsuccess('cart item saved');
            }
            public function cart(){
                $usercartitem=Cart::userCartItems();
               // dd($usercartitem);

                //dd($usercartitem);
               // $getattributeprice=Productattribute::where(['product_id'=>$usercartitem['product_id'],'size'=>$usercartitem['size']])->first()->toArray();

             //dd($usercartitem);
               if(empty($usercartitem)){
                   return back()->withdanger('no products in your cart');
               }
                $getsections=Section::with('categories')->where('status',1)->get();

              //  dd($usercartitem);
                return view('Frontend.cart.showcart')
                ->withsections($getsections)
                ->withcartitems($usercartitem);
            }
            public function updatecartquantity(Request $request){
                if($request->ajax()){
                    $data=$request->all();
                   $usercartitem=Cart::userCartItems();
                    $cart=Cart::where('id',$data['cartid'])->first()->toArray();
                    $stock=Productattribute::select('stock')->where(['product_id'=>$cart['product_id'],'size'=>$cart['size']])->first()->toArray();
                   // echo"<pre>";print_r($data);die;
                    if($data['qty']> $stock['stock']){
                        return response()->json([
                            'status'=>false,
                            'message'=>'You cannot add more than there is available',
                            'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]); 
                        } 
                        $activesize=Productattribute::where(['product_id'=>$cart['product_id'],'size'=>$cart['size'],'status'=>1])->count();
                          if($activesize==0){
                            return response()->json([
                                'status'=>false,
                                'message'=>'size is not active',
                                'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]); 
                            
                          }
                    Cart::where('id',$data['cartid'])->update([
                      'quantity'=>$data['qty'],
                    ]);
                    $TotalCartItems=TotalCartItems();
                   return response()->json([
                       'TotalCartItems'=>$TotalCartItems,
                        'status'=>true,
                        'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]);
                }
            }
            public function deletecartitemwithajax(Request $request){
                if($request->ajax()){
                    $data=$request->all();
                   // echo"<pre>";print_r($data);die;
                    Cart::where('id',$data['cartid'])->delete();

                    $usercartitem=Cart::userCartItems();
                    $TotalCartItems=TotalCartItems();

                  //  return view('Frontend.cart.cartitems')->withcartitems($usercartitem);
                  return response()->json([
                    'TotalCartItems'=>$TotalCartItems,  
                    'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]);
                   
                }
            }

    public function applycoupon(Request $request){
        if($request->ajax()){
            $data=$request->all();
        // echo"<pre>";print_r($data);die;
        $usercartitem=Cart::userCartItems();
        $TotalCartItems=TotalCartItems();

        $couponcount=Coupon::where('couponcode', $data['couponcode'])->first();
        if(!$couponcount){
            $usercartitem=Cart::userCartItems();
            $TotalCartItems=TotalCartItems();
            return response()->json(
                [
                    
                 'status'=>false,
                'message'=>'Invalid coupon',
                'TotalCartItems'=>$TotalCartItems,  
                'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]);
       
        }else{
           //check for other coupon conditions
          $coupondetails=Coupon::where('couponcode',$data['couponcode'])->first();

          if($coupondetails->status==0){
              $message="The coupon is inactive";
          }
          $expirydate=$coupondetails->expirydate;
        //  echo"<pre>";print_r($expirydate);die;
          $currentdate=date('Y-m-d');
          if($expirydate < $currentdate){
          //  echo"<pre>";print_r($expirydate);die;

              $message="Coupon is already expired";
          }
         
           //check if coupon is from selected category
           $categoryarray=explode(",",$coupondetails->categories);
           $usercartitem=Cart::userCartItems();
           if(!empty($coupondetails->users)){
            $usersemailsaray=explode(",",$coupondetails->users);
            //get user ids;
            foreach($usersemailsaray as $key=>$user){
                $getuserids=User::select('id')->where('email',$user)->first()->toArray();
                $userid[]=$getuserids['id'];
            }  
        }
          //if user is supposed to get a coupon
        
          $totalamount=0;
          foreach($usercartitem  as $key=>$item){
            if(!in_array($item['product']['category_id'],$categoryarray)){
                $message="Coupon is not for one of the selected products";
            }
            if (!empty($coupondetails->users)) {
                if (!in_array($item['user_id'], $userid)) {
                    $message="You are not assigned any coupon";
                }
            }
              $attributeprice=Product::getdiscountedattrprice($item['product_id'],$item['size']);
              $totalamount=$totalamount+($attributeprice['discounted_price']*$item['quantity']);

          }
          //echo $totalamount;die;
           if(isset($message)){
            $usercartitem=Cart::userCartItems();
            $TotalCartItems=TotalCartItems();
            $couponamount=0;
            return response()->json(
                [
                    
                 'status'=>false,
                'message'=>$message,
                'couponamount'=>$couponamount,  
                'TotalCartItems'=>$TotalCartItems,  
                'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]);

          }else{
            //  echo"<pre>";print_r("coupon can be successfully redemeed");die;
            //check if amount type is fixed or percentage
            if($coupondetails->amounttype=="fixed"){
                $couponamount=$coupondetails->amount;
            }else{
                $couponamount=$totalamount*($coupondetails->amount/100);
            }
            $grand_total=$totalamount-$couponamount;

            //echo $couponamount;
            //add coupon code and mount in sesssion
          Session::put('couponamount',$couponamount);
          Session::put('couponcode',$data['couponcode']);
         //  echo $couponamount;
            $message="Coupon code code applied successfully";
            $TotalCartItems=TotalCartItems();
            $usercartitem=Cart::userCartItems();
            return response()->json(
                [
                    
                 'status'=>true,
                'message'=>$message,
                'TotalCartItems'=>$TotalCartItems,  
                'couponamount'=>$couponamount,  
                'grand_total'=>$grand_total,  
                'view'=>(String)View::make('Frontend.cart.cartitems')->withcartitems($usercartitem)]);


          }
        
       
           

        } 
        }

    }
}
