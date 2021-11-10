<?php
use App\Models\Product;
?>
@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Catalogues</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Order details</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">orders table</h3>
            </div>
         
            @include('layouts.adminlayout.adminpartials.alerts')
         <div class="row">
             <div class="col-md-6">
                 <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer details</h3>
                            </div>
                                <div class="card-body">
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
                                        <tr>
                                            <td>Payment gateway</td>
                                            <td>{{$orders['paymentgateway']}}</td>
                                        </tr>
                        
                        
                                    </table>
                                 </div>
                                </div>  
                     </div>
                     <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delivery Address</h3>
                            </div>
                             <div class="card-body">
                                <table class="table table-responsive table-bordered ">
                                    <tr>
                                        <td colspan="2"><strong>Delivery address</strong></td>
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
                    </div>
                 </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Customer details</h3>
                                </div>
                                    <div class="card-body">
                                        <table class="table table-responsive table-bordered ">                                        
                                            <tr>
                                                <td>Name</td>
                                                <td>{{$customerdetails['first_name']}} {{$customerdetails['last_name']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{$customerdetails['email']}}</td>
                                            </tr>
                                           
                            
                            
                                        </table>
                                     </div>
                                    </div>
                          </div>
                          <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Billing Address</h3>
                                </div>
                                    <div class="card-body">
                                        <table class="table table-responsive table-bordered ">                                        
                                           
                                            <tr>
                                                <td >Name</td>
                                                <td>{{$customerdetails['first_name']}} {{$customerdetails['last_name']}}</td>
                                            </tr>
                                            <tr>
                                                <td >Address</td>
                                                <td>{{$customerdetails['address']}}</td>
                                            </tr>
                                            <tr>
                                                <td >City</td>
                                                <td>{{$customerdetails['city']}}</td>
                                            </tr>
                                            <tr>
                                                <td >state</td>
                                                <td>{{$customerdetails['state']}}</td>
                                            </tr>
                                            <tr>
                                                <td >Country</td>
                                                @if (!empty($customerdetails['country']['country_name']))
                                                <td>{{$customerdetails['country']['country_name']}}</td>          
                                                @endif
                                            </tr>
                                            <tr>
                                                <td >pincode</td>
                                                <td>{{$customerdetails['pincode']}}</td>
                                            </tr>
                                            <tr>
                                                <td >Mobile</td>
                                                <td>{{$customerdetails['mobile']}}</td>
                                            </tr>
                            
                                           
                            
                            
                                        </table>
                                     </div>
                                    </div>
                          </div>
                          <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Update order Status</h3>
                                </div>
                                    <div class="card-body">
                                        <table class="table table-responsive table-bordered ">                                        
                                           

                                            <form method="POST" action="{{ route('update.orderstatus')}}">
                                             @csrf
                                                <tr>
                                                <td colspan="2 {{$errors->has('order_status')?' has-error':''}}">
                                                    <input type="hidden" name="order_id" value="{{$orders['id']}}" >

                                                    <select name="order_status"  class="form-control" id="orderstatusses">
                                                        <option value="" >Select status</option>
                                                        @foreach ($orderstatuses as $orderstatus)
                                                            <option value="{{$orderstatus['name']}}"@if ($orders['orderstatus']==$orderstatus['name'])
                                                                selected
                                                            @endif>{{$orderstatus['name']}}</option>
                                                        @endforeach
                                                    </select><br>
                                                    @if ($errors->has('order_status'))
                                                        <span class="help-block text-danger">{{$errors->first('order_status')}}</span>
                                                    @endif &nbsp;&nbsp;
                                                    <input style="width: 120px;" value="{{isset($orders['courier_name'])?$orders['courier_name']:''}}" type="text" name="couriername" @if(empty($orders['courier_name'])) id="couriername" @endif placeholder="Courier name"/>
                                                    <input style="width: 120px;" value="{{isset($orders['tracking_number'])?$orders['tracking_number']:''}}" type="text" name="trackingnumber" @if(empty($orders['tracking_number'])) id="trackingnumber" @endif placeholder="tracking number"/>
                                                </td>
                                                <td>
                                                    
                                                    <button type="submit" class="btn btn-default">Update</button>

                                                </td>

                                            </tr>
                                                   <th colspan="2" style="color: green">Status</th><th colspan="2" style="color: green">Date</th>
                                                    @foreach ($orderlogs as $logs)
                                                    <tr>
                                                        <td colspan="2">
                                                            <strong>{{$logs['order_status']}}</strong>
                                                            
                                                        </td>
                                                        <td>
                                                            <strong>{{date('F j, Y, g:i a',strtotime($logs['created_at']))}}</strong>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    
                                        </form>
                                          
                                           
                                           
                            
                            
                                        </table>
                                     </div>
                                    </div>
                          </div>
                          
                      </div>
                    </div>
                    
          </div>
                     
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ordered Products</h3>
                        </div>
                        <div class="card-body">
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
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection