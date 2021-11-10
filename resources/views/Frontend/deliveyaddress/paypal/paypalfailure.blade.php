<?php Use App\Models\Product;?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('cart.show') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Checkout</li>
    </ul>
	<h3>  Checkout</h3>	
	<hr class="soft"/>
	
	@include('layouts.adminlayout.adminpartials.alertss')
			<div align="center">
                <h3 class="text-center">Payment failed</h3>
                <p>The payments  for  Order number  {{Session::get('order_id')}} and the amount USD: {{Session::get('grandtotall')/108}} failed: Please try again after some time </p>
              



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