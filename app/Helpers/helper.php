<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function TotalCartItems(){
      if(Auth::check()){
          $totalcartitems=Cart::where('user_id',Auth::user()->id)->sum('quantity');
      }else{
             $session_id=Session::get('session_id');
             $totalcartitems=Cart::where('session_id',$session_id)->sum('quantity');
      }
      return $totalcartitems;
  }

?>