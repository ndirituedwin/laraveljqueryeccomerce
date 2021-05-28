<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function getorders(){
        Session::put('page','orders');

        $userorders=Order::with('orders_products')->orderBy('id','DESC')->get()->toArray();
      //   dd($userorders);
        return view('admin.Orders.getorders')->withorders($userorders);
    }
    public function getsingleorder($orderid){
        $singleorder=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
        $customerdetails=User::with('country')->where('id',$singleorder['user_id'])->first()->toArray();
        $orderstatuses=OrderStatus::where('status',1)->get()->toArray();
     // dd($customerdetails);
        return view('admin.Orders.singleorder')
        ->withcustomerdetails($customerdetails)
        ->withorderstatuses($orderstatuses)
        ->withorders($singleorder);
    }
    public function updateorderstatus(Request $request){
        if($request->isMethod('post')){
         //  dd($request);
            $this->validate($request,[
                'order_id'=>'required',
                'order_status'=>'required',
            ]);
           // dd($request);
            Order::where('id',$request['order_id'])->update(['orderstatus'=>$request['order_status']]);
            return redirect()->route('admin.orders')->withsuccess('order statuses updated successfully');
        }
    }

}
