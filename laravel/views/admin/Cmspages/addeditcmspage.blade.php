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
              <li class="breadcrumb-item active">Cms pages</li>
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


          <form action="{{isset($cmspage['id'])? route('cmspage.modify',$cmspage['id']): route('cmspage.modify') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-grop{{$errors->has('title')?' has-error text-danger':''}}">
                    <label for="title" class="control-label">Cms page title</label>
                    <input type="text" name="title" value="{{isset($cmspage['title'])?$cmspage['title']:Request::old('title')}}" id="title" class="form-control" placeholder="enter cms page title">
                    @if ($errors->has('title'))
                    <span class="help-block text-danger">{{$errors->first('title')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('description')?' has-error text-danger':''}}">
                    <label for="description" class="control-label">Cms page description</label>

                    <textarea type="text" name="description"  id="description" class="form-control" placeholder="enter cms page description">{{isset($cmspage['id'])?$cmspage['description']:Request::old('description')}}</textarea>
                    @if ($errors->has('description'))
                    <span class="help-block text-danger">{{$errors->first('description')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('meta_title')?' has-error text-danger':''}}">
                    <label for="meta_title" class="control-label">Cms meta title</label>

                    <textarea type="text" name="meta_title"  id="meta_title" class="form-control" placeholder="enter cms page meta_title">{{isset($cmspage['id'])?$cmspage['meta_title']:Request::old('meta_title')}}</textarea>
                    @if ($errors->has('meta_title'))
                    <span class="help-block text-danger">{{$errors->first('meta_title')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('meta_description')?' has-error text-danger':''}}">
                    <label for="meta_description" class="control-label">Cms meta description</label>

                    <textarea type="text" name="meta_description"  id="meta_description" class="form-control" placeholder="enter cms page meta_description">{{isset($cmspage['id'])?$cmspage['meta_description']:Request::old('meta_description')}}</textarea>
                    @if ($errors->has('meta_description'))
                    <span class="help-block text-danger">{{$errors->first('meta_description')}}</span>
                @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grop{{$errors->has('meta_keyword')?' has-error text-danger':''}}">
                    <label for="meta_keyword" class="control-label">Cms meta keyword</label>

                    <textarea type="text" name="meta_keyword"  id="meta_keyword" class="form-control" placeholder="enter cms page meta_keyword">{{isset($cmspage['id'])?$cmspage['meta_keyword']:Request::old('meta_keyword')}}</textarea>
                    @if ($errors->has('meta_keyword'))
                    <span class="help-block text-danger">{{$errors->first('meta_keyword')}}</span>
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
           <button type="submit" class="btn btn-primary"> {{ isset($cmspage['id'])?' Update':' Add' }} cmspage</button>
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
