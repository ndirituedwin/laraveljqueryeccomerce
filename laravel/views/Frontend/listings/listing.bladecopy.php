<?php Use App\Models\Product;?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('cart.show') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Thanks</li>
    </ul>
	<h3>  Thanks[</h3>	
	<hr class="soft"/>
	
	@include('layouts.adminlayout.adminpartials.alertss')
			
 <form name="checkoutform" id="checkoutform" action="{{ route('checkout.page') }}" method="POST">
     @csrf 
  <table class="table table-bordered">
		<tr><td> DELIVER ADDRESS  <a href="{{ route('delivery.add') }}" class="btn btn-success">Add delivery address</a></td></tr> 
        @foreach ($deliveryaddres as $deliveryaddres)
        <tr> 
            <td>
                   <div class="control-group" style="float: left{{$errors->has('address_id')? 'has-error text-danger':''}}">
                    <input type="radio" id="{{$deliveryaddres['id']}}" name="address_id" value="{{$deliveryaddres['id']}}">&nbsp;&nbsp;
                
                  </div>
                   <div class="control-group">
                     <label class="control-label" for="addressname"  >{{$deliveryaddres['name']}},{{$deliveryaddres['address']}},{{$deliveryaddres['city']}},{{$deliveryaddres['state']}},{{$deliveryaddres['country']}}</label>  
                     @if ($errors->has('address_id'))
                     <span class="help-block text-danger"><font color="red">{{$errors->first('address_id')}}</font> </span> 
                       @endif
                    </div>
               
             </td>
             <td>
              <a href="{{ route('delivery.edit', ['id'=>$deliveryaddres['id']]) }}">Edit</a>
              <a href="{{ route('delivery.deleteaddess', ['id'=>$deliveryaddres['id']]) }}" class="addressdelete">Delete</a>
            </td>
             </tr>
        @endforeach
	
	</table>	


    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Pro/cat/Discount</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
            @if (!empty($cartitems))
            <?php $totalprice=0;?>
            @foreach ($cartitems as $cartitem)
            <?php
            $productattributeprice=Product::getdiscountedattrprice($cartitem['product_id'],$cartitem['size']);
            ?>
            <tr>
              <td> 
         
                @if (!empty($cartitem['product']['productimage']))
                  <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$cartitem['product']['productimage'])}}">
    
    
                      @endif       
                               </td>
              <td>{{((isset($cartitem['product']['productname'])?$cartitem['product']['productname']:''))}}
                  <br/>Color:{{(isset($cartitem['product']['productcolor'])?$cartitem['product']['productcolor']:'')}}
              <br/>Size:{{(isset($cartitem['size'])?$cartitem['size']:'')}}
              </td>
              <td>
                {{(isset($cartitem['quantity'])?$cartitem['quantity']:'')}}
              </td>
              <td>Kshs/={{$productattributeprice['productprice']}}</td>
              <td>{{$productattributeprice['discount']}}</td>
              <td>Kshs/={{($productattributeprice['discounted_price']) * ($cartitem['quantity'])}}</td>
            </tr> 
            <?php $totalprice=$totalprice+( $productattributeprice['discounted_price'] * $cartitem['quantity'] )?>
            @endforeach
            @endif          
          <tr>
            <td colspan="6" style="text-align:right">Total Price:	</td>
            <td>Kshs/=@if (!empty($totalprice))
                {{$totalprice}}
            @endif</td>
          </tr>
           <tr>
            <td colspan="6" style="text-align:right">Coupon Discount:	</td>
            <td class="couponamount">
  @if (Session::has('couponamount'))
                     -Ksh.{{Session::get('couponamount')}}
                     @else
                     Ksh.0
                 @endif 
                   
              
            </td>
          </tr>
          
           <tr>
            <td colspan="6" style="text-align:right"><strong>Grand TOTAL (Kshs @if (!empty($totalprice))
                 {{$totalprice}}-<span class="couponamount">Kshs</span>)=</strong>
            @endif</td>
              
            <td class="label label-important" style="display:block"> <strong class="grand_total">Ksh:/=@if (!empty($totalprice))
                {{$grandtotall= $totalprice-Session::get('couponamount')}}
                <?php Session::put('grandtotall',$grandtotall);?>
            @endif
               
            </strong></td>
          </tr>
          </tbody>
      </table>





		
            <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
			
				<div class="control-group{{$errors->has('payment_gateway')? 'has-error text-danger':''}}">
				<label for="payment_gateway" class="control-label"><strong> Payment method: </strong> </label>
				<div class="controls">

            <span >
              <input type="radio" name="payment_gateway" id="COD" value="COD"><span>&nbsp;<strong>COD</strong>&nbsp;&nbsp;
              <input type="radio" name="payment_gateway" id="paypal" value="Paypal">&nbsp;<strong>Paypal</strong>
              @if ($errors->has('payment_gateway'))
              <span class="help-block text-danger"><font color="red">{{$errors->first('payment_gateway')}}</font> </span> 
                @endif
            </span>
          
					</div>
				</div>
				</td>
                </tr>
				
			</tbody>
			</table>
			
		
	<a href="{{ route('cart.show') }}" class="btn btn-large"><i class="icon-arrow-left"></i> back to cart </a>
	<button type="submit" class="btn btn-large pull-right">Place Order<i class="icon-arrow-right"></i></button>
    </form>
</div>
@endsection