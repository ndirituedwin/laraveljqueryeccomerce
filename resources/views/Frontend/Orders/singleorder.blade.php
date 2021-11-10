<?php
use App\Models\Product;
?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('frontend.index') }}">Home</a> <span class="divider">/</span></li>
		<li class="active"><a href="{{ route('user.orders') }}">Orders</a></li>
    </ul>
	@include('layouts.adminlayout.adminpartials.alertss')
    <h3>Order no.{{$orders['id']}} Details</h3>
	<hr class="soft"/>

    <div class="row">
	
        <div class="span4">
            <table class="table table-responsive table-bordered ">
                <tr>
                    <td colspan="2"><strong>Order Details</strong></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td>{{date('d-m-Y',strtotime($orders['created_at']))}}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{$orders['orderstatus']}}</td>
                </tr>
                  @if(!empty($orders['courier_name'])&& !empty($orders['tracking_number']))
                  <tr>
                    <td>Courier name</td>
                    <td>{{$orders['courier_name']}}</td>
                </tr>
                <tr>
                    <td>Tracking  number</td>
                    <td>{{$orders['tracking_number']}}</td>
                </tr>
                  @endif
                <tr>
                    <td>Order Total</td>
                    <td>{{$orders['grandtotal']}}</td>
                </tr>
                <tr>
                    <td>Shipping charges</td>
                    <td>{{(isset($orders['shippingcharges'])?$orders['shippingcharges']:'0.00')}}</td>
                </tr>
                <tr>
                    <td>Coupon code</td>
                    <td>{{$orders['couponcode']}}</td>
                </tr>
                <tr>
                    <td>Coupon amount</td>
                    <td>{{(isset($orders['couponamount'])?$orders['couponamount']:'0.00')}}</td>
                </tr>
                <tr>
                    <td>Payment method</td>
                    <td>{{$orders['paymentmethod']}}</td>
                </tr>


            </table>
         </div>
         <div class="span4">
            <table class="table table-responsive table-bordered ">
                <tr>
                    <td class="colspan2"><strong>Delivery address</strong></td>
                </tr>
                <tr>
                    <td >Name</td>
                    <td>{{$orders['name']}}</td>
                </tr>
                <tr>
                    <td >Address</td>
                    <td>{{$orders['address']}}</td>
                </tr>
                <tr>
                    <td >City</td>
                    <td>{{$orders['city']}}</td>
                </tr>
                <tr>
                    <td >state</td>
                    <td>{{$orders['state']}}</td>
                </tr>
                <tr>
                    <td >Country</td>
                    <td>{{$orders['country']}}</td>
                </tr>
                <tr>
                    <td >pincode</td>
                    <td>{{$orders['pincode']}}</td>
                </tr>
                <tr>
                    <td >Mobile</td>
                    <td>{{$orders['mobile']}}</td>
                </tr>

                
            </table>  
         </div>
    </div>
    
	<div class="row">
		<div class="span8">
		   <table class="table table-responsive table-bordered ">
               <tr>
                <td>Product Image</td>
                <th>Product Code</th>
                <th>Product name</th>
                <th>Product size</th>
                <th>Product color</th>
                <th>Product quantity</th>
            </tr>
            @if (!empty($orders))
                @foreach ($orders['orders_products'] as $product)
                <tr>
                    <td>
                        <?php
                         $getproductimage=Product::orderproductimage($product['product_id']);
                        $getproductslug=Product::getproductslug($product['product_id'])     
                        ?>
                       <a target="_blank" href="{{ route('singlepro.getdetails',$getproductslug) }}"><img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$getproductimage)}}" ></a>
                    </td>
                    <td>{{$product['product_code']}}</td>
                    <td>{{$product['product_name']}}</td>
                    <td>{{$product['product_size']}}</td>
                    <td>{{$product['product_color']}}</td>
                    <td>{{$product['product_quantity']}}</td>
                        </tr>  

                @endforeach
             
            @endif
           
           </table>
		</div>
		
	</div>	
	
</div>
@endsection