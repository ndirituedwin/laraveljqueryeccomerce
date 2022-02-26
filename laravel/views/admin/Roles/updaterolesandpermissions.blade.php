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
              <li class="breadcrumb-item active">Update roles</li>
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
          <form action="{{ route('admin.updateroles',$admindetails['id']) }}" method="POST" role="form" >
          @csrf
            <div class="card-body">
                @php
                //   $viewcat="";
                //   $editcat="";
                //   $fullaccesscat="";
                //   $viewbrands="";
                //   $editbrands="";
                //   $fullaccessbrands="";
                //   $viewproducts="";
                //   $editproducts="";
                //   $fullaccessproducts="";
                //    $vieworders="";
                //   $editorder="";
                //   $fullaccessorder="";
                @endphp
                @if (!empty($adminroles))
                @foreach ($adminroles as $role)
                @if (!empty($role['module'] && $role['module']=="brands"))
                @if ($role['view_access']==1)
                   @php $viewbrands="checked"; @endphp
                   @else
                   @php $viewbrands=""; @endphp
                @endif
                @if ($role['edit_access']==1)
                @php $editbrands="checked"; @endphp
                @else
                @php $editbrands=""; @endphp
               @endif
               @if ($role['full_access']==1)
                @php $fullaccessbrands="checked"; @endphp
                @else
                @php $fullaccessbrands=""; @endphp
               @endif
               @else

                @endif


                @endforeach
                @endif

            <div class="row">
              <div class="col-md-12">
                  <div class="form-group{{$errors->has('brands')?' has-error text-danger':''}}">
                      <label for="brands" class="control-label col-md-3">Brand</label>
                      <div class="col-md-9">
                          <input type="checkbox" name="brands[view]" value="1" {{ $viewbrands }}> View access &nbsp;&nbsp;&nbsp;
                          <input type="checkbox" name="brands[edit]" value="1" {{$editbrands  }}> View/edit/delete access &nbsp;&nbsp;&nbsp;
                          <input type="checkbox" name="brands[full]" value="1" {{ $fullaccessbrands }}> full access
                      </div>
                      @if ($errors->has('brands'))
                      <span class="help-block text-danger">{{$errors->first('brands')}}</span>
                  @endif
                  </div>
              </div>
              @if (!empty($adminroles))
              @foreach ($adminroles as $role)
              @if (!empty($role['module'] && $role['module']=="categories"))
              @if ($role['view_access']==1)
                 @php $viewcat="checked"; @endphp
                 @else
                 @php $viewcat=""; @endphp
              @endif
              @if ($role['edit_access']==1)
              @php $editcat="checked"; @endphp
              @else
              @php $editcat=""; @endphp
             @endif
             @if ($role['full_access']==1)
              @php $fullaccesscat="checked"; @endphp
              @else
              @php $fullaccesscat=""; @endphp
             @endif
             @else

              @endif


              @endforeach
              @endif
              <div class="col-md-12">
                <div class="form-group{{$errors->has('categories')?' has-error text-danger':''}}">
                    <label for="categories" class="control-label col-md-3">Categories</label>
                    <div class="col-md-9">
                        <input type="checkbox" name="categories[view]" value="1"  {{ ($viewcat)?$viewcat :''}}> View access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="categories[edit]" {{ $editcat }} value="1"> View/edit/delete access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="categories[full]" {{ $fullaccesscat }} value="1"> full access
                    </div>
                    @if ($errors->has('categories'))
                    <span class="help-block text-danger">{{$errors->first('categories')}}</span>
                @endif
                </div>
            </div>
            @if (!empty($adminroles))
            @foreach ($adminroles as $role)
            @if (!empty($role['module'] && $role['module']=="products"))
            @if ($role['view_access']==1)
               @php $viewproducts="checked"; @endphp
               @else
               @php $viewproducts=""; @endphp
            @endif
            @if ($role['edit_access']==1)
            @php $editproducts="checked"; @endphp
            @else
            @php $editproducts=""; @endphp
           @endif
           @if ($role['full_access']==1)
            @php $fullaccessproducts="checked"; @endphp
            @else
            @php $fullaccessproducts=""; @endphp
           @endif
           @else

            @endif


            @endforeach
            @endif
            <div class="col-md-12">
                <div class="form-group{{$errors->has('products')?' has-error text-danger':''}}">
                    <label for="products" class="control-label col-md-3">Products</label>
                    <div class="col-md-9">
                        <input type="checkbox" name="products[view]" value="1" {{$viewproducts }}> View access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="products[edit]" value="1" {{$editproducts }}> View/edit/delete access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="products[full]" value="1" {{  $fullaccessproducts }}> full access
                    </div>
                    @if ($errors->has('products'))
                    <span class="help-block text-danger">{{$errors->first('products')}}</span>
                @endif
                </div>
            </div>
            @if (!empty($adminroles))
            @foreach ($adminroles as $role)
            @if (!empty($role['module'] && $role['module']=="orders"))
            @if ($role['view_access']==1)
               @php $vieworders="checked"; @endphp
               @else
               @php $vieworders=""; @endphp
            @endif
            @if ($role['edit_access']==1)
            @php $editorder="checked"; @endphp
            @else
            @php $editorder=""; @endphp
           @endif
           @if ($role['full_access']==1)
            @php $fullaccessorder="checked"; @endphp
            @else
            @php $fullaccessorder=""; @endphp
           @endif
           @else

            @endif


            @endforeach
            @endif
            <div class="col-md-12">
                <div class="form-group{{$errors->has('orders')?' has-error text-danger':''}}">
                    <label for="orders" class="control-label col-md-3">Orders</label>
                    <div class="col-md-9">
                        <input type="checkbox" name="orders[view]"  value="1" {{ $vieworders }}> View access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="orders[edit]" value="1" {{ $editorder }}> View/edit/delete access &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="orders[full]" value="1" {{ $fullaccessorder }}> full access
                    </div>
                    @if ($errors->has('orders'))
                    <span class="help-block text-danger">{{$errors->first('orders')}}</span>
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
           <button type="submit" class="btn btn-primary">update role</button>
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
