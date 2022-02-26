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
              <li class="breadcrumb-item active">{{ $title }}</li>
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
            <h3 class="card-title">{{ $title }}</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->


          <form action="{{isset($admindata['id'])? route('admin.addedit',$admindata['id']): route('admin.addedit') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-grop{{$errors->has('name')?' has-error text-danger':''}}">
                    <label for="name" class="control-label">Admin Name</label>
                    <input type="text" name="name" value="{{isset($admindata['name'])?$admindata['name']:Request::old('name')}}" id="name" class="form-control" placeholder="enter admin name">
                    @if ($errors->has('name'))
                    <span class="help-block text-danger">{{$errors->first('name')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('type')?' has-error text-danger':''}}">
                    <label for="type" class="control-label">Admin type</label>
                 <select name="type" class="form-control">
                    <option value="admin" {{ ($admindata['type']=="admin")? 'selected ':'' }}>Admin</option>
                    <option value="subadmin" {{ ($admindata['type']=="subadmin")? 'selected ':'' }}>Sub Admin</option>
                </select>
                    @if ($errors->has('type'))
                    <span class="help-block text-danger">{{$errors->first('type')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('mobile')?' has-error text-danger':''}}">
                    <label for="mobile" class="control-label">Admin Mobile</label>

                    <input type="text" name="mobile"  id="mobile" class="form-control" placeholder="enter admin mobile"  value="{{isset($admindata['email'])?$admindata['mobile']:Request::old('mobile')}}"/>
                    @if ($errors->has('mobile'))
                    <span class="help-block text-danger">{{$errors->first('mobile')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('email')?' has-error text-danger':''}}">
                    <label for="email" class="control-label">Admin email</label>
                    <input disabled type="text" name="email"  id="email" class="form-control" placeholder="enter admin email"value="{{isset($admindata['email'])?$admindata['email']:Request::old('email')}}"/>
                    @if ($errors->has('email'))
                    <span class="help-block text-danger">{{$errors->first('email')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('password')?' has-error text-danger':''}}">
                    <label for="password" class="control-label">Admin password</label>
                    <input type="text" name="password"  id="password" class="form-control" placeholder="enter admin password"value=""/>
                    @if ($errors->has('password'))
                    <span class="help-block text-danger">{{$errors->first('password')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6 form-group{{$errors->has('image')?' has-error':''}}">
                <label for="exampleInputFile" class="control-label">Admin Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
                @if ($errors->has('image'))
                <span class="help-block text-danger">{{$errors->first('image')}}</span>
            @endif
            <br>
                @if (!empty($admindata['image']))
                <img style="object-fit: cover;width: 50px;height: 100px;" src="/storage/adminlte/adminimages/images/profile/{{$admindata['image']}}" alt="">
                 <a href="javascript:void(0)" class="confirmdelete" record="image" recordid="{{$admindata['id']}}">Delete admin image</a>
                @endif
              </div>

            {{-- <div class="col-md-6 form-group{{$errors->has('image')?' has-error text-danger':''}}">
                <label for="image" class="control-label">Image</label>
                <input type="file" name="image"  id="image"  placeholder="password again" class="form-control"><br>
                @if (!empty($admindata['image']))
                <div style="width: 10px">

                    <img src="/storage/adminlte/adminimages/images/profile/{{$admindata['image']}}" alt="" >
                </div>
                 {{-- <a target="_blank" href=""></a> --}}
                {{-- @endif
                @if ($errors->has('image'))
                <span class="help-block text-danger">{{$errors->first('image')}}</span>
            @endif --}}
              {{-- </div>  --}}
            </div>
            <!-- /.row -->


            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary"> {{ isset($admindata['id'])?' Update':' Add' }} Admin</button>
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
