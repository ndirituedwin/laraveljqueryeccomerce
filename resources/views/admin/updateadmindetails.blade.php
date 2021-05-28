@extends('layouts.adminlayout.adminlayout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update admin details</h3>
                </div><br>
                <!-- /.card-header -->
                <!-- form start -->
                @include('layouts.adminlayout.adminpartials.alerts')
                <form action="{{ route('update.admindetails') }}" method="POST" enctype="multipart/form-data"  role="form">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                       
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email}}" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="admintype">Admin Type</label>
                        <input type="type" class="form-control" name="type" value="{{Auth::guard('admin')->user()->type}}" id="type" readonly>
                      </div>
                    <div class="form-group{{$errors->has('name')?' has-error':''}}">
                      <label for="name" class="control-label">Name</label>
                      <input type="text" name="name" value="{{Request::old('name')?: Auth::guard('admin')->user()->name}}" class="form-control" id="name">
                       @if ($errors->has('name'))
                           <span class="help-block text-danger">{{$errors->first('name')}}</span>
                       @endif
                    </div>
                    <div class="form-group{{$errors->has('mobile')?' has-error':''}}">
                      <label for="mobile" class="control-label">Mobile</label>
                      <input type="mobile" name="mobile" id="mobile" value="{{Request::old('mobile')?: Auth::guard('admin')->user()->mobile}}" class="form-control">
                      @if ($errors->has('mobile'))
                          <span class="help-block">{{$errors->first('mobile')}}</span>
                      @endif
                  </div>
                  <div class="form-group{{$errors->has('mobile')?' has-error text-danger':''}}">
                      <label for="image" class="control-label">Image</label>
                      <input type="file" name="image"  id="image"  placeholder="password again" class="form-control"><br>
                      @if (!empty(Auth::guard('admin')->user()->image))
                      <img src="/storage/adminlte/adminimages/images/{{Auth::guard('admin')->user()->image}}" alt="" style="border-radius: 20%; width: 40px,height:40px">
                          
                      @endif
                      @if ($errors->has('image'))
                      <span class="help-block text-danger">{{$errors->first('image')}}</span>
                  @endif
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
  
             
  
  
             
             
            </div>
          
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
    
@endsection