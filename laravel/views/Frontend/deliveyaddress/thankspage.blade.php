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
                <h3 class="text-center">Your Order Has been Placed Successfully</h3>
                <p>Your Order number is {{Session::get('order_id')}} and grand total is Kshs:/={{Session::get('grandtotall')}} </p>
            </div>
</div>
@endsection
<?php
 Session::forget('grandtotall');
 Session::forget('order_id');
 Session::forget('couponcode');
Session::forget('couponamount');
?>