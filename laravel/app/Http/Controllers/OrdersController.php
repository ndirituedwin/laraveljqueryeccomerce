<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function getuserorders(){
     //   dd("A");
        $userorders=Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get()->toArray();
       // dd($userorders);
        $getsections=Section::with('categories')->where('status',1)->get();
        return view('Frontend.Orders.getorders')->withorders($userorders)->withsections($getsections);
    }
    public function viewuserorderdetails($id){
       $userorders=Order::with('orders_products')->where(['id'=>$id])->orderBy('id','DESC')->first()->toArray();
    //  dd($userorders);
        $getsections=Section::with('categories')->where('status',1)->get();
        return view('Frontend.Orders.singleorder')->withsections($getsections)->withorders($userorders);
     
    }
}
