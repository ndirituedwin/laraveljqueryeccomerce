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
              <li class="breadcrumb-item active">Product attributes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
          <form action="{{ route('admin.attribute',$product) }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Product attributes form</h3>
                @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                
                  <div class="form-grop{{$errors->has('productname')?' has-error text-danger':''}}">
                      <label for="productname" class="control-label">product name</label>
                      <input type="text" readonly name="productname" value="{{Request::old('productname')?:$product->productname}}" id="productname" class="form-control" placeholder="enter a product">
                      @if ($errors->has('productname'))
                      <span class="help-block text-danger">{{$errors->first('productname')}}</span>
                  @endif
                  </div>
                      <div class="form-grop{{$errors->has('productcode')?' has-error text-danger':''}}">
                  <label for="productcode" class="control-label">product code</label>
                  <input type="text" readonly name="productcode" value="{{Request::old('productcode')?:$product->productcode}}" id="productcode" class="form-control" placeholder="enter a productcode">
                  @if ($errors->has('productcode'))
                  <span class="help-block text-danger">{{$errors->first('productcode')}}</span>
              @endif
              </div>     
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              
              <div class="form-grop{{$errors->has('productcolor')?' has-error text-danger':''}}">
                <label for="productcolor" class="control-label">product color</label>
                <input type="text" readonly name="productcolor" value="{{Request::old('productcolor')?:$product->productcolor}}" id="productcolor" class="form-control" placeholder="enter a product color">
                @if ($errors->has('productcolor'))
                <span class="help-block text-danger">{{$errors->first('productcolor')}}</span>
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
            <div class="form-group">
                <div class="field_wrapper">
                    <div>
                        <input type="text" required style="width: 100px" name="size[]" value="" id="size" placeholder="size"/>
                        <input type="text" required style="width: 100px" name="sku[]" value="" id="sku" placeholder="sku"/>
                        <input type="number" required style="width: 100px" name="price[]" value="" id="price" placeholder="price"/>
                        <input type="number" required style="width: 100px" name="stock[]" value="" id="stock" placeholder="stock"/>
                         <a href="javascript:void(0)" class="add_button" title="Add field">Add</a>
                    </div>
                </div>
            </div>
        </div>            
            </div>
          </div>
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

        </form>
        <!-- /.card -->
        <form action="{{ route('edit.productattribute',$product) }}" name="editattributeform" method="POST" role="form">
          @csrf
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products attributes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="attributes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>product name </th>
                  <th>Size </th>
                  <th>Sku </th>
                  <th>Price </th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($product->attributes as $attribute)
                        <input style="display: none" type="text"  name="attrid[]" value="{{$attribute->id}}">
                          <tr>
                            <td>{{$product->productname}}</td>
                            <td>{{$attribute->size}}</td>
                            <td>{{$attribute->sku}}</td>
                            <td>
                            <input type="number" name="price[]" value="{{$attribute->price}}" required>
                            </td>
                            <td>
                             <input type="number" name="stock[]" value="{{$attribute->stock}}" required>

                            </td>
                              <td>@if ($attribute->status==1)
                                <a class="updateattributestatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}" href="javascript:void(0)">Active</a>
                                 @else
                               <a class="updateattributestatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}" href="javascript:void(0)">In active</a>
                             @endif
                            </td> 
 
                            <td>
                             <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="attribute" recordid="{{$attribute->id}}" title="trash product attribute"></a>
                            </td>
                           
                           
                           </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update attributes</button>
             </div>
   
            <!-- /.card-body -->
          </div>
        </form>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection