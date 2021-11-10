<?php Use App\Models\Product;?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9" style="background-color: indianred">
    <ul class="breadcrumb">
		<li><a href="{{ route('cart.show') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Checkout</li>
    </ul>
	<h3>  Checkout</h3>	
	<hr class="soft"/>
	
	@include('layouts.adminlayout.adminpartials.alertss')
			<div align="center" >
                <h3 class="text-center">Your Order Has been Placed Successfully</h3>
                <p>Your Order number is {{Session::get('order_id')}} and the amount to be paid is  grand total is Kshs:/={{Session::get('grandtotall')/108}} </p>

               <!--paypal form  for test mode-->


               {{-- sandbox test <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> --}}
                <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
                  {{-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post"> --}}
                    <input type="hidden" name="cmd" value="_xclick">
                {{--sand box testing email <input type="hidden" name="business" value="sb-kckwz6427405@business.example.com"> --}}
                <input type="hidden" name="business" value="sb-kckwz6427405@business.example.com">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
                <input type="hidden" name="amount" value="{{round(Session::get('grandtotall'),2)/108}}">
                <input type="hidden" name="first_name" value="{{$orderdetails['name']}}">
                <input type="hidden" name="last_name" value="{{$orderdetails['name']}}">
                <input type="hidden" name="address1" value="{{$orderdetails['address']}}">
                <input type="hidden" name="address2" value="">
                <input type="hidden" name="city" value="{{$orderdetails['city']}}">
                <input type="hidden" name="state" value="{{$orderdetails['state']}}">
                <input type="hidden" name="zip" value="{{$orderdetails['pincode']}}">
                <input type="hidden" name="email" value="{{$orderdetails['email']}}">
                <input type="hidden" name="country" value="{{$orderdetails['country']}}">
                <input type="hidden" name="return" value="{{ route('paypal.success') }}">
                <input type="hidden" name="cancel_return" value="{{ route('paypal.failed')}}">
                <input type="hidden" name="notify_url" value="{{ url('paypal/ipn') }}">
                 <input type="image" name="submit"
                  src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
                  alt="PayPal - The safer, easier way to pay online"> 
                  {{-- <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                  <img alt="" src="https://www.paypalobjects.com/en_US/i/src/pixel.gif" width="1" height="1"> --}}
              </form>



               <!--end of paypa test form-->
            </div>
</div>
@endsection
<?php
//  Session::forget('grandtotall');
//  Session::forget('order_id');
//  Session::forget('couponcode');
// Session::forget('couponamount');
?>