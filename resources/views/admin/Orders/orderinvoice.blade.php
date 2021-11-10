{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    </style>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$singleorder['id']}}</h3>
                <br>
                <span class="pull-right"><?php 
                                                //  echo DNS2D::getBarcodeHTML($singleorder['id'],'QRCODE')

                echo DNS1D::getBarcodeHTML($singleorder['id'],'C39')
                // echo DNS2D::getBarcodeHTML($singleorder['id'],'QRCODE')
                ?></span><br>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<b style="color: green">Name: </b>{{$customerdetails['first_name']}} {{$customerdetails['last_name']}}<br>
    					<b style="color: green">Email: </b>{{$customerdetails['email']}}
                        @if (!empty($customerdetails['address']))
                        <b style='color: green'>Address: </b>{{$customerdetails['address']}}
                        @endif
                        @if (!empty($customerdetails['city']))
                        <b style='color: green'>City: </b>{{$customerdetails['city']}} <br>
                        @endif
                        @if (!empty($customerdetails['state']))
                        <b style='color: green'>City: </b>{{$customerdetails['state']}}                            
                        @endif
                        @if (!empty($customerdetails['country']))
                        <b style='color: green'>City: </b>{{$customerdetails['country']}}  <br>                          
                        @endif
                        
                        @if (!empty($customerdetails['mobile']))
                        <b style='color: green'>Mobile: </b>{{$customerdetails['mobile']}}

                            
                        @endif

    			
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
                    <b style="color: green">Name: </b>{{$singleorder['name']}}<br>
                    <b style="color: green">Address: </b>{{$singleorder['address']}} <b style="color: green">City:</b> {{$singleorder['city']}}<br>
                    <b style="color: green">State: </b>{{$singleorder['state']}} <b style="color: green">Country: </b>{{$singleorder['country']}}<br>
                    <b style="color: green">Mobile: </b>{{$singleorder['mobile']}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<b style="color: green">Payment Method: </b>{{$singleorder['paymentmethod']}}<br>
    					 <b style="color: green">Payment gateway: </b>{{$singleorder['paymentgateway']}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{date('F j, Y, g:i a',strtotime($singleorder['created_at']))}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed table-responsive table-hover">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							@php
                                 $subtotal=0;
                                 $grandtotal=0   
                                @endphp
                               @foreach ($singleorder['orders_products']  as $order)
                               <tr >
                                <td>Name: {{$order['product_name']}} <br>
                                  Code:  {{$order['product_code']}} <br>

                               Size: {{$order['product_size']}}  <br>
                                 Color: {{$order['product_color']}}
                                 <?php echo DNS1D::getBarcodeHTML($order['product_code'],'C39')
                                //  echo DNS2D::getBarcodeHTML($order['product_code'],'QRCODE')
                                 ?>
                                
                                </td>
                                <td class="text-center">Kshs/={{$order['product_price']}}</td>
                                <td class="text-center">{{$order['product_quantity']}}</td>
                                <td class="text-right">{{$order['product_price']*$order['product_quantity']}}</td>

                            </tr>
                               @php
                                   $subtotal=$subtotal+($order['product_price']*$order['product_quantity'])
                               @endphp
                               @endforeach
                                
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">Ksh/={{$subtotal}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">Kshs/={{$singleorder['shippingcharges']}}</td>
    							</tr>
                                  @if ($singleorder['couponamount']>0)
                                  <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Disount</strong></td>
    								<td class="no-line text-right">Kshs/={{isset($singleorder['couponamount'])?$singleorder['couponamount']:'0'}}</td>
    							</tr>
                                      
                                  @endif
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Grand Total</strong></td>
    								<td class="no-line text-right">Kshs/={{$singleorder['grandtotal']}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>