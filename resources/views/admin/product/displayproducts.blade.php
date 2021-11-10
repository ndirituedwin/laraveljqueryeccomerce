@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Products</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
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
              <h3 class="card-title">Products table</h3>
            </div>
            <a href="{{ route('admin.getproducts') }}" class="btn btn-success">Add product</a><br>
            <!-- /.card-header -->
            @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-body">
              <table id="products" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>product name </th>
                  <th>product category</th>
                  <th>product section</th>
                  <th>product Image</th>
                  <th>product code</th>
                  <th>product color</th>
                  <th>product status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($products as $product)
                          <tr>
                            <td>{{$product->productname}}</td>
                            <td>{{(isset($product->category->categoryname)?$product->category->categoryname:'')}}</td>
                            <td>{{(isset($product->section->section)?$product->section->section:'')}}</td>
                            <td>
                              <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product->productimage?>
                              @if (!empty($product->productimage) && file_exists($smallpath))
                                  <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product->productimage)}}" alt="{{$product->productname}}">
                             @else
                             <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product->productname}}">

                                  @endif
                            </td>
                            <td>{{$product->productcode}}</td>
                            <td>{{$product->productcolor}}</td>
                            <td>@if ($product->status==1)
                               <a class="updateproductstatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">Active</a>
                                @else
                              <a class="updateproductstatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">In active</a>
                            @endif</td>
                            <td>
                              <a href="{{ route('admin.attribute', $product) }}" title="add attribute" class="fas fa-plus"></a>&nbsp;
                              <a href="{{ route('admin.addmultipleimages', $product) }}" title="add image" class="fas fa-plus-circle"></a>&nbsp;
                              <a href="{{ route('admin.modifyproduct', $product) }}" class="fas fa-edit" title="edit product"></a>
                              <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="product" recordid="{{$product->id}}" title="trash product"></a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products Table</h3>
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