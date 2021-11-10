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
              <li class="breadcrumb-item active">Product multiple images</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
          <form action="{{ route('admin.addmultipleimages',$product) }}" enctype="multipart/form-data" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Product multiple images form</h3>
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
                  <input type="text" readonly name="productcode" value="{{Request::old('productcode')?:$product->productcode}}"  id="productcode" class="form-control" placeholder="enter a productcode">
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
              
                        @if (!empty($product->productimage))
                <img src="/adminlte/adminimages/images/adminproducts/small/{{$product->productimage}}" alt="">           
                 <a href="javascript:void(0)" class="confirmdelete" record="productimage" recordid="{{$product->id}}">Delete product image</a>
                @endif
              </div>
              </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="field_wrapper">
                  <label for="">Add multiple images</label>
                    <div>
                        <input multiple type="file"   name="image[]" value="" id="image" class="form-control" />
                      
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
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products images</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="attributes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>product name </th>
                  <th>image </th>
                  <th>Status </th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($product->productimages as $image)
                          <tr>
                            <td>{{$product->productname}}</td>
                            <td>
                                <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$image->image?>
                                @if (!empty($image->image) && file_exists($smallpath))
                                    <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$image->image)}}" alt="{{$product->productname}}">
                               @else
                               <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product->productname}}">
  
                                    @endif
                              </td>
                              <td>@if ($image->status==1)
                                <a class="updateimagestatus" id="imagestatus-{{$image->id}}" image_id="{{$image->id}}" href="javascript:void(0)">Active</a>
                                 @else
                               <a class="updateimagestatus" id="imagestatus-{{$image->id}}" image_id="{{$image->id}}" href="javascript:void(0)">In active</a>
                             @endif
                                     </td>
                            <td>
                              &nbsp;
                              <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="imageproduct" recordid="{{$image->id}}" title="trash product image"></a>
                    
                            </td>
                           
                           </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
          
            <!-- /.card-body -->
          </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection