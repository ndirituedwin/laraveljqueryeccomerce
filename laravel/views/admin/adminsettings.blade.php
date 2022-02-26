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
                  <h3 class="card-title">Update password</h3>
                </div><br>
                <!-- /.card-header -->
                <!-- form start -->
                @include('layouts.adminlayout.adminpartials.alerts')
                <form action="{{ route('admin.settings') }}" method="POST"  role="form">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputEmail1">AdminName</label>
                            <input type="name" class="form-control" name="name" value="{{Auth::guard('admin')->user()->name}}" id="name"  readonly>
                          </div>
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email" value="{{Auth::guard('admin')->user()->email}}" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Admin Type</label>
                        <input type="type" class="form-control" name="type" value="{{Auth::guard('admin')->user()->type}}" id="type" readonly>
                      </div>
                    <div class="form-group{{$errors->has('currentpassword')?' has-error':''}}">
                      <label for="currentpassword" class="control-label">Current Password</label>
                      <input type="password" name="currentpassword" class="form-control" id="currentpassword" placeholder="current password">
                       @if ($errors->has('currentpassword'))
                           <span class="help-block text-danger">{{$errors->first('currentpassword')}}</span>
                       @endif
                      <span id="checkcurrentpassword"></span>
                    </div>
                    <div class="form-group{{$errors->has('password')?' has-error':''}}">
                      <label for="password" class="control-label">Your password</label>
                      <input type="password" name="password" id="password" placeholder="your password" class="form-control">
                      @if ($errors->has('password'))
                          <span class="help-block">{{$errors->first('password')}}</span>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="password_confirmation" class="control-label">Password again</label>
                      <input type="password" name="password_confirmation" id="password_confirmation"  placeholder="password again" class="form-control">
                     <span id="checkconfirmpassword"></span>
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