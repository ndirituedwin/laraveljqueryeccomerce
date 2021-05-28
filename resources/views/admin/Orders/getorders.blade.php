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
                <li class="breadcrumb-item active">Orders</li>
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
            <div class="card-body">
              <table id="orders" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Order Id </th>
                    <th>Order date </th>
                    <th>client name </th>
                    <th>client email </th>
                    <th>Ordered orders</th>
                    <th>Ordered amount </th>
                    <th>Order status </th>
                    <th>Payment method </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @if (!empty($orders))
                   @foreach ($orders as $order)
                   <tr>
                     <td>{{$order['id']}}</td>
                     <td>{{date('d-m-Y',strtotime($order['created_at']))}}</td>
                     <td>{{($order['name'])}}</td>
                     <td>{{($order['email'])}}</td>
                     <td>
                         @foreach ($order['orders_products'] as $ordr)
                             {{$ordr['product_code']}},{{$ordr['product_name']}},({{$ordr['product_quantity']}})
                         @endforeach
                     </td>
                     <td>{{$order['grandtotal']}}</td>
                    
                     <td>{{$order['orderstatus']}}</td>
                     <td>{{$order['paymentmethod']}}</td>
                     <td>
                       <a href="{{ route('orders.getsingle', $ordr['id']) }}" title="View Order Details" class="fas fa-file"></a>&nbsp;
                                 </td>
                 </tr>
                 @endforeach
                       
                   @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>

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