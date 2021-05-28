@extends('layouts.adminlayout.adminlayout')
@section('content')

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
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Brands form</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <form action="{{ route('admin.modifybrand') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-grop{{$errors->has('brand')?' has-error text-danger':''}}">
                      <label for="categoryname" class="control-label">Brand name</label>
                      <input type="text" name="brand" value="{{Request::old('brand')}}" id="brand" class="form-control" placeholder="enter a brand">
                      @if ($errors->has('brand'))
                      <span class="help-block text-danger">{{$errors->first('brand')}}</span>
                  @endif
                  </div>       
              </div>
              <!-- /.col -->
           
              <!-- /.col -->
            </div>
            <!-- /.row -->

            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Add brand</button>
          </div>
        </form>
        </div>
        <!-- /.card -->

       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection