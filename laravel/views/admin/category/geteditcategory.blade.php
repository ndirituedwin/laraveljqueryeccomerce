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
              <li class="breadcrumb-item active">Categories</li>
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
          <div class="cardi-header">
            <h3 class="card-title">Edit Category form</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
           
          </div>
          <!-- /.card-header -->
          <form action="{{ route('category.getedit',$categoriesedit) }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-grop{{$errors->has('categoryname')?' has-error text-danger':''}}">
                      <label for="categoryname" class="control-label">Category name</label>
                      <input type="text" name="categoryname" value="{{Request::old('categoryname')?:$categoriesedit['categoryname']}}" id="categoryname" class="form-control" placeholder="enter a category">
                      @if ($errors->has('categoryname'))
                      <span class="help-block text-danger">{{$errors->first('categoryname')}}</span>
                  @endif
                  </div>
                <div id="appendcategorieshere">
                  @include('admin.category.appendcategorylevels')       
                </div>          
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group{{$errors->has('sections')?' has-error':''}}">
                    <label>Select section</label>
                    <select class="form-control select2" id="sectiononchange" name="sections" style="width: 100%;">
                      <option value="">select</option>
                      @foreach ($sections as $section)
                          <option value="{{$section->id}}"@if ($categoriesedit['section_id']==$section->id)
                              selected
                          @endif>{{$section->section}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('sections'))
                        <span class="help-block text-danger">{{$errors->first('sections')}}</span>
                    @endif
                  </div>
                <!-- /.form-group -->
                <div class="form-group{{$errors->has('categoryimage')?' has-error':''}}">
                    <label for="exampleInputFile" class="control-label">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="categoryimage" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    @if ($errors->has('categoryimage'))
                    <span class="help-block text-danger">{{$errors->first('categoryimage')}}</span>
                @endif
                <br>
                @if (!empty($categoriesedit['categoryimage']))
                <img src="/adminlte/adminimages/images/admincategories/{{$categoriesedit['categoryimage']}}" alt="">           
                 <a href="javascript:void(0)" class="confirmdelete" record="image" recordid="{{$categoriesedit['id']}}">Delete image</a>
                @endif
                  </div>     
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group{{$errors->has('categorydescription')?' has-error text-danger':''}}">
                  <label for="categorydiscount">Category discount</label>
                      <input type="number" name="categorydiscount" id="categorydiscount" class="form-control" value="{{Request::old('categorydiscount')?:$categoriesedit['categorydiscount']}}" placeholder="enter  categorydiscount">
                      @if ($errors->has('categorydiscount'))
                      <span class="help-block text-danger">{{$errors->first('categorydiscount')}}</span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('categorydescription')?' has-error text-danger':''}}">
                    <label for="categorydescription">Category description</label>
                        <textarea class="form-control" name="categorydescription" id="categorydescription" rows="3">{{Request::old('categorydescription')?:$categoriesedit['description']}}</textarea>
                        @if ($errors->has('categorydescription'))
                        <span class="help-block text-danger">{{$errors->first('categorydescription')}}</span>
                    @endif
                  </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group{{$errors->has('categoryurl')?' has-error text-danger':''}}">
                  <label for="categoryurl">Category url</label>
                      <input type="text" name="categoryurl" id="categoryurl" value="{{Request::old('categoryurl')?:$categoriesedit['url']}}" class="form-control" placeholder="enter  categoryurl">
                      @if ($errors->has('categoryurl'))
                      <span class="help-block text-danger">{{$errors->first('categoryurl')}}</span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('metatitle')?' has-error text-danger':''}}">
                    <label for="metatitle">meta title</label>
                    <textarea name="metatitle" id="metatitle" rows="3" class="form-control">{{Request::old('metatitle')?:$categoriesedit['metatitle']}}</textarea>
                    @if ($errors->has('metatitle'))
                        <span class="help-block text-danger">{{$errors->first('metatitle')}}</span>
                    @endif
                  </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group{{$errors->has('metadescription')?' has-error text-danger':''}}">
                    <label for="metadescription">meta description</label>
                    <textarea name="metadescription" id="metadescription" rows="3" class="form-control">{{Request::old('metadescription')?:$categoriesedit['metadescription']}}</textarea>
                    @if ($errors->has('metadescription'))
                        <span class="help-block text-danger">{{$errors->first('metadescription')}}</span>
                    @endif
                  </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group{{$errors->has('metakeyword')?' has-error text-danger':''}}">
                  <label for="metakeyword" >meta keywords</label>
                  <textarea name="metakeyword" id="metakeyword" rows="3" class="form-control">{{Request::old('metakeyword')?:$categoriesedit['metakeywords']}}</textarea>
                  @if ($errors->has('metakeyword'))
                      <span class="help-block ">{{$errors->first('metakeyword')}}</span>
                  @endif
                </div>
              </div>          
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Update category</button>
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