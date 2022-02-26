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
              <li class="breadcrumb-item active">Banners</li>
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
            <h3 class="card-title">Banners form</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <form action="{{ route('banner.getadd') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group{{$errors->has('title')?' has-error':''}}">
                    <label>Add title</label>
                      <input type="text" name="title" value="{{Request::old('title')}}" class="form-control" id="title">
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">{{$errors->first('title')}}</span>
                    @endif
                  </div>
                  <div class="form-grop{{$errors->has('alt')?' has-error text-danger':''}}">
                      <label for="alt" class="control-label">Alt name</label>
                      <input type="text" name="alt" value="{{Request::old('alt')}}" id="alt" class="form-control" placeholder="enter a product">
                      @if ($errors->has('alt'))
                      <span class="help-block text-danger">{{$errors->first('alt')}}</span>
                  @endif
                  </div>
                 
              </div>
              <div class="col-md-6">
                <div class="div"></div>
                <div class="form-grop{{$errors->has('link')?' has-error text-danger':''}}">
                  <label for="link" class="control-label">banner link</label>
                 <input type="text" name="link" value="{{Request::old('link')}}" class="form-control" id="link">
                  @if ($errors->has('link'))
                  <span class="help-block text-danger">{{$errors->first('link')}}</span>
              @endif
              </div>  
              
                         <div class="form-group{{$errors->has('image')?' has-error':''}}">
                <label for="exampleInputFile" class="control-label">banner Image</label>
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
              </div>
    
              </div>
              <!-- /.col -->
      
             

              <!-- /.col -->
            </div>
            <!-- /.row -->

           
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Add banner</button>
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