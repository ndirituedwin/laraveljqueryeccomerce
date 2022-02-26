@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>brands page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">brands</li>
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
              <h3 class="card-title">brands table</h3><br>
              <a class="btn btn-success float-right" href="{{ route('admin.modifybrand') }}">Add brand</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="brands" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>brand</th>
                  <th>status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($brands as $brand)
                          <tr>
                            <td>{{$brand->brand}}</td>
                            <td>@if ($brand->status==1)
                               <a class="updatebrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" href="javascript:void(0)"><i title="Active" class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                @else
                              <a class="updatebrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" href="javascript:void(0)"><i title="In active" class="fas fa-toggle-off " aria-hidden="true" status="In active"></i></a>
                            @endif</td>
                            <td>
                                <a href="{{ route('brand.edit', $brand) }}" class="fas fa-edit"></a>
                                <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="brand" recordid="{{$brand->id}}"></a>
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