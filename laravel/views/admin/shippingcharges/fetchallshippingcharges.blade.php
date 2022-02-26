@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Shipping charges</h1>
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
              <h3 class="card-title">Shippings table</h3>
            </div>
         
            @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-body">
              <table id="orders" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th> Id </th>
                    <th>country code </th>
                    <th>country </th>
                    <th>0-500g  </th>
                    <th>501-1000g  </th>
                    <th>1001-2000g  </th>
                    <th>2001-5000g </th>
                    <th>above_5000g</th>
                    <th>status</th>
                    <th>updated at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @if (!empty($shippingcharges))
                   @foreach ($shippingcharges as $shippingcharge)
                   <tr>
                     <td>{{$shippingcharge['id']}}</td>
                     <td>{{($shippingcharge['country_code'])}}</td>
                     <td> {{($shippingcharge['country_name'])}}</td>
                     <td>Kshs {{($shippingcharge['zero_500g'])}}</td>
                     <td>Kshs {{($shippingcharge['fivezeroone_1000g'])}}</td>
                     <td>Kshs {{($shippingcharge['onezerozeroone_2000g'])}}</td>
                     <td>Kshs {{($shippingcharge['twozerozeroone_5000g'])}}</td>
                     <td>Kshs {{($shippingcharge['above_5000g'])}}</td>
                     <td>
                         @if ($shippingcharge['status']==1)
                         <a class="updateshippingstatus" id="shipping-{{$shippingcharge['id']}}"  shipping_id="{{$shippingcharge['id']}}" href="javascript:void(0)">Active</a>
                         @else
                       <a class="updateshippingstatus" id="shipping-{{$shippingcharge['id']}}"  shipping_id="{{$shippingcharge['id']}}" href="javascript:void(0)">In active</a>
 
                         {{-- <a class="updateshippingstatus" shipping_id="{{$shippingcharge['id']}}" id="shipping-{{$shippingcharge['id']}}" href="javascript:void(0)" title="" ><i aria-hidden="true" status="Active" class="fas fa-toggle-on"></i></a>&nbsp;
                            @else
                            <a class="updateshippingstatus" shipping_id="{{$shippingcharge['id']}}" id="shipping-{{$shippingcharge['id']}}" href="javascript:void(0)" title="" ><i aria-hidden="true" status="Inactive" class="fas fa-toggle-off"></i></a>&nbsp;
                        --}}
                         @endif
                     
                    </td>
                    <td>{{date('d-m-Y',strtotime($shippingcharge['updated_at']))}}</td>
                    <td>
                        <a href="{{ route('admin.editshippingcharge', $shippingcharge['id']) }}" title="" ><i aria-hidden="true" status="inactive" class="fas fa-edit"></i></a>&nbsp;

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