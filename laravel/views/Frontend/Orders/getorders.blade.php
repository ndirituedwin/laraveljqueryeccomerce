
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('frontend.index') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
    </ul>
	@include('layouts.adminlayout.adminpartials.alertss')
    <h3>Orders</h3>
	<hr class="soft"/>
	<div class="row">
		<div class="span8">
		   <table class="table table-responsive table-bordered ">
               <tr>
                <th>Order Id</th>
                <th>Order Products</th>
                <th>Payment method</th>
                <th>Grand Total</th>
                <th>Created On</th>
                <th>View Details</th>
            </tr>
            @if (!empty($orders))
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order['id']}}</td>
                    <td>
                        @foreach ($order['orders_products'] as $ordr)
                            {{$ordr['product_code']}},{{$ordr['product_name']}}
                        @endforeach
                    </td>
                    <td>{{$order['paymentmethod']}}</td>
                        <td>{{$order['grandtotal']}}</td>
                            <td>{{date('d-m-Y',strtotime($order['created_at']))}}</td>
        <td><a style="text-decoration: underline;color: blue" href="{{ route('order.viewitdetails', ['id'=>$order['id']]) }}">View Details</a></td>

                        </tr>  

                @endforeach
             
            @endif
           
           </table>
		</div>
		
	</div>	
	
</div>
@endsection