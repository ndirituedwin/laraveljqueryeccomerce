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
              <li class="breadcrumb-item active">Products</li>
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
            <h3 class="card-title">Products form</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <form action="{{ route('admin.modifyproduct',$product) }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group{{$errors->has('category')?' has-error':''}}">
                    <label>Select category</label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="">select</option>
                      @foreach ($categoriess as $section)
                          <optgroup label="{{$section->section}}"></optgroup>
                          @foreach ($section->Categories as $category)
                          <option value="{{$category->id}}" @if (!empty(@old('category')) && $category->id==@old('category'))@elseif(!empty($product->category_id) && $product->category_id==$category->id)
                              selected=""
                          @endif style="background-color: green"> &raquo;{{$category->categoryname}}</option>
                          @if (!empty($category->subcategories))
                              @foreach ($category->subcategories as $subcategory)
                              <option value="{{$subcategory->id}}" @if (!empty(@old('category')) && @old('category')==$subcategory->id)@elseif(!empty($product->category_id) && $product->category_id==$subcategory->id)
                                selected=""
                            @endif  style="background-color: rgb(9, 0, 128)"> &nbsp; &nbsp; &nbsp;&raquo;{{$subcategory->categoryname}}</option>       
                              @endforeach
                          @endif
                          @endforeach
                          @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="help-block text-danger">{{$errors->first('category')}}</span>
                    @endif
                  </div>
                  <div class="form-grop{{$errors->has('productname')?' has-error text-danger':''}}">
                      <label for="productname" class="control-label">product name</label>
                      <input type="text" name="productname" value="{{Request::old('productname')?:$product->productname}}" id="productname" class="form-control" placeholder="enter a product">
                      @if ($errors->has('productname'))
                      <span class="help-block text-danger">{{$errors->first('productname')}}</span>
                  @endif
                  </div>
                         
              </div>
              <div class="col-md-6">
                <div class="div"></div>
                <div class="form-grop{{$errors->has('brand')?' has-error text-danger':''}}">
                  <label for="brand" class="control-label">brand name</label>
                  <select name="brand" id="brand" class="form-control">
                    <option value="">select</option>
                    @foreach ($brands as $brand)
                       <option value="{{$brand->id}}" @if (!empty($product->brand_id) && $product->brand_id== $brand->id)
                           selected
                       @endif
                     >{{$brand->brand}}</option>                          
                    @endforeach
                  </select>
                  @if ($errors->has('brand'))
                  <span class="help-block text-danger">{{$errors->first('brand')}}</span>
              @endif
              </div>   
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-grop{{$errors->has('productcode')?' has-error text-danger':''}}">
                  <label for="productcode" class="control-label">product code</label>
                  <input type="text" name="productcode" value="{{Request::old('productcode')?:$product->productcode}}" id="productcode" class="form-control" placeholder="enter a productcode">
                  @if ($errors->has('productcode'))
                  <span class="help-block text-danger">{{$errors->first('productcode')}}</span>
              @endif
              </div>
              <div class="form-grop{{$errors->has('productcolor')?' has-error text-danger':''}}">
                <label for="productcolor" class="control-label">product color</label>
                <input type="text" name="productcolor" value="{{Request::old('productcolor')?:$product->productcolor}}" id="productcolor" class="form-control" placeholder="enter a product color">
                @if ($errors->has('productcolor'))
                <span class="help-block text-danger">{{$errors->first('productcolor')}}</span>
            @endif
            </div>
              </div>

              <div class="col-md-6">
                <div class="form-grop{{$errors->has('productprice')?' has-error text-danger':''}}">
                  <label for="productprice" class="control-label">product price</label>
                  <input type="number" name="productprice" value="{{Request::old('productprice')?:$product->productprice}}" id="productprice" class="form-control" placeholder="enter a productprice">
                  @if ($errors->has('productprice'))
                  <span class="help-block text-danger">{{$errors->first('productprice')}}</span>
              @endif
              </div>
              <div class="form-grop{{$errors->has('productdiscount')?' has-error text-danger':''}}">
                <label for="productdiscount" class="control-label">product discount (%)</label>
                <input type="number" name="productdiscount" value="{{Request::old('productdiscount')?:$product->productdiscount}}" id="productdiscount" class="form-control" placeholder="enter a product discount">
                @if ($errors->has('productdiscount'))
                <span class="help-block text-danger">{{$errors->first('productdiscount')}}</span>
            @endif
            </div>
              </div>
              <div class="col-md-6">
 
                <div class="form-grop{{$errors->has('productweight')?' has-error text-danger':''}}">
                  <label for="productweight" class="control-label">product weight</label>
                  <input type="text" name="productweight" value="{{Request::old('productweight')?:$product->productweight}}" id="productweight" class="form-control" placeholder="enter a productweight">
                  @if ($errors->has('productweight'))
                  <span class="help-block text-danger">{{$errors->first('productweight')}}</span>
              @endif
              </div>
              <div class="form-group{{$errors->has('productimage')?' has-error':''}}">
                <label for="exampleInputFile" class="control-label">product Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="productimage" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
                @if ($errors->has('productimage'))
                <span class="help-block text-danger">{{$errors->first('productimage')}}</span>
            @endif
            <br>
                @if (!empty($product->productimage))
                <img src="/adminlte/adminimages/images/adminproducts/small/{{$product->productimage}}" alt="">           
                 <a href="javascript:void(0)" class="confirmdelete" record="productimage" recordid="{{$product->id}}">Delete product image</a>
                @endif
              </div>

              </div>
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('productdescription')?' has-error text-danger':''}}">
                    <label for="productdescription">Product description</label>
                    <textarea name="productdescription" rows="2" class="form-control">{{Request::old('productdescription')?:$product->productdescription}}</textarea>
                    @if ($errors->has('productdescription'))
                        <span class="help-block text-danger">{{$errors->first('productdescription')}}</span>
                    @endif
                  </div>
                  <div class="form-group{{$errors->has('washcare')?' has-error text-danger':''}}">
                    <label for="washcare">Wash care</label>
                    <input type="text" name="washcare" value="{{Request::old('washcare')?:$product->washcare}}" id="washcare" class="form-control" placeholder="enter washcare">
                    @if ($errors->has('washcare'))
                        <span class="help-block text-danger">{{$errors->first('washcare')}}</span>
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group{{$errors->has('fabric')?' has-error text-danger':''}}">
                    <label for="fabric">fabric</label>
                     <select name="fabric" id="fabric" class="form-control">
                       <option value="">Select</option>
                       @foreach ($fabrics as $fabric)
                       <option value="{{$fabric}}" @if ($product->fabric==$fabric)
                           selected

                       @endif>{{$fabric}}</option>
                       @endforeach
                     </select>
                               @if ($errors->has('fabric'))
                        <span class="help-block text-danger">{{$errors->first('fabric')}}</span>
                    @endif
                  </div>

                  <div class="form-group{{$errors->has('pattern')?' has-error text-danger':''}}">
                    <label for="pattern">pattern</label>
                     <select name="pattern" id="pattern" class="form-control">
                       <option value="">select pattern</option>
                       @foreach ($patterns as $pattern)
                       <option value="{{$pattern}}"@if ($product->pattern===$pattern)
                           selected
                       @endif>{{$pattern}}</option>
                       @endforeach
                     </select>
                               @if ($errors->has('pattern'))
                        <span class="help-block text-danger">{{$errors->first('pattern')}}</span>
                    @endif
                  </div>
             
                </div>
                <div class="col-md-6">

                  <div class="form-group{{$errors->has('sleeve')?' has-error text-danger':''}}">
                    <label for="sleeve">sleeve</label>
                     <select name="sleeve" id="sleeve" class="form-control">
                       <option value="">sleeve</option>
                       @foreach ($sleeves as $sleeve)
                       <option value="{{$sleeve}}" @if ($product->sleeve==$sleeve)
                           selected
                       @endif>{{$sleeve}}</option>
                       @endforeach
                     </select>
                               @if ($errors->has('sleeve'))
                        <span class="help-block text-danger">{{$errors->first('sleeve')}}</span>
                    @endif
                  </div>

                  <div class="form-group{{$errors->has('fit')?' has-error text-danger':''}}">
                    <label for="fit">fit</label>
                     <select name="fit" id="fit" class="form-control">
                       <option value="">fit</option>
                       @foreach ($fits as $fit)
                       <option value="{{$fit}}" @if ($product->fit==$fit)
                           selected
                       @endif>{{$fit}}</option>
                       @endforeach
                     </select>
                               @if ($errors->has('fit'))
                        <span class="help-block text-danger">{{$errors->first('fit')}}</span>
                    @endif
                  </div>
               
                </div>
                <div class="col-md-6">


                  <div class="form-group{{$errors->has('occassion')?' has-error text-danger':''}}">
                    <label for="occassion">occassion</label>
                     <select name="occassion" id="occassion" class="form-control">
                       <option value="">occassion</option>
                       @foreach ($occassions as $occassion)
                       <option value="{{$occassion}}" @if ($product->occassion==$occassion)
                           selected
                       @endif>{{$occassion}}</option>
                       @endforeach
                     </select>
                               @if ($errors->has('occassion'))
                        <span class="help-block text-danger">{{$errors->first('occassion')}}</span>
                    @endif
                  </div>
                  <div class="form-group{{$errors->has('metattitle')?' has-error text-danger':''}}">   
                  <label for="metattitle">metattitle</label>
                  <textarea name="metattitle" id="metattitle"  rows="2" class="form-control">{{Request::old('metattitle')?:$product->metattitle}}</textarea>
                  @if ($errors->has('metattitle'))
                  <span class="help-block text-danger">{{$errors->first('metattitle')}}</span>
              @endif
                </div>
                
                </div>
                <div class="col-md-6">

                  <div class="form-group{{$errors->has('metadescription')?' has-error text-danger':''}}">   
                    <label for="metadescription">meta description</label>
                    <textarea name="metadescription" id="metadescription"  rows="2" class="form-control">{{Request::old('metadescription')?:$product->metadescription}}</textarea>
                    @if ($errors->has('metadescription'))
                    <span class="help-block text-danger">{{$errors->first('metadescription')}}</span>
                @endif
                  </div>
                  <div class="form-group{{$errors->has('metakeyword')?' has-error text-danger':''}}">   
                    <label for="metakeyword">meta keyword</label>
                    <textarea name="metakeyword" id="metakeyword"  rows="2" class="form-control">{{Request::old('metakeyword')?:$product->metakeyword}}</textarea>
                    @if ($errors->has('metakeyword'))
                    <span class="help-block text-danger">{{$errors->first('metakeyword')}}</span>
                @endif
                  </div>
                  <div class="form-group{{$errors->has('featured')?' has-error text-danger':''}}">   
                    <label for="featured">
                      <input type="checkbox" name="featured" id="featured" value="1"
                      @if ($product->featured==1)
                          checked
                      @endif
                      > featured
                    </label>
                  </div>
                </div>
            
              <!-- /.col -->
            </div>
            <!-- /.row -->

           
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Update product</button>
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