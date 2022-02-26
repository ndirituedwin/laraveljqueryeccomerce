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
            <li class="breadcrumb-item active">Coupons</li>
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
          <h3 class="card-title">Coupons form</h3>
              @include('layouts.adminlayout.adminpartials.alerts')
         
        </div>
        <!-- /.card-header -->
        <form action="{{ route('coupon.getadd') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group{{$errors->has('couponoption')?' has-error text-danger':''}}">
                  <label for="couponoption" class="control-label">Add coupon option</label><br>
                  <span><input id="automaticcoupon" checked type="radio" name="couponoption" value="Automatic">Automatic
                    &nbsp;&nbsp;
                    <span><input id="manualcoupon" type="radio" name="couponoption" value="Manual">Manual
                      &nbsp;&nbsp;
                      @if ($errors->has('couponoption'))
                    <span class="help-block text-danger">{{$errors->first('couponoption')}}</span>
                @endif
                </div>
                
                <div class="form-grop{{$errors->has('couponcode')?' has-error text-danger':''}}" style="display: none" id="couponfield">
                    <label for="couponcode" class="control-label">coupon code </label>
                    <input type="text" name="couponcode" value="{{Request::old('couponcode')}}" id="couponcode" class="form-control" placeholder="enter coupon code">
                    @if ($errors->has('couponcode'))
                    <span class="help-block text-danger">{{$errors->first('couponcode')}}</span>
                @endif
                </div>
                <div class="form-group{{$errors->has('coupontype')?' has-error text-danger':''}}">
                  <label for="coupontype" class="control-label">Add coupon type</label><br>
                  <span><input  type="radio" checked name="coupontype" value="multiple times">multiple times
                    &nbsp;&nbsp;
                    <span><input  type="radio"  name="coupontype" value="single times">single times
                      &nbsp;&nbsp; @if ($errors->has('coupontype'))
                      <span class="help-block text-danger">{{$errors->first('coupontype')}}</span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('amounttype')?' has-error text-danger':''}}">
                  <label for="amounttype" class="control-label">Amount type</label><br>
                  <span><input  type="radio" checked name="amounttype" value="percentage">percentage(%)
                    &nbsp;&nbsp;
                    <span><input  type="radio" name="amounttype" value="fixed">fixed
                      &nbsp;&nbsp;@if ($errors->has('amounttype'))
                      <span class="help-block text-danger">{{$errors->first('amounttype')}}</span>
                  @endif
                </div>              
            </div>
            <div class="col-md-6">
              <div class="form-grop{{$errors->has('categories')?' has-error text-danger':''}}">
                <label for="categories" class="control-label">Categories</label>
                <select class="form-control select2" id="category" multiple="" name="categories[]" style="width: 100%;">
                  <option value="">select</option>
                  @foreach ($categoriess as $section)
                      <optgroup label="{{$section->section}}"></optgroup>
                      @foreach ($section->Categories as $category)
                      <option value="{{$category->id}}" @if (!empty(@old('category')) && $category->id==@old('category'))
                          selected=""
                      @endif style="background-color: green"> &raquo;{{$category->categoryname}}</option>
                      @if (!empty($category->subcategories))
                          @foreach ($category->subcategories as $subcategory)
                          <option value="{{$subcategory->id}}" @if (!empty(@old('category')) && @old('category')==$subcategory->id)
                            selected=""
                        @endif  style="background-color: rgb(9, 0, 128)"> &nbsp; &nbsp; &nbsp;&raquo;{{$subcategory->categoryname}}</option>       
                          @endforeach
                      @endif
                      @endforeach
                      @endforeach
                </select>
                @if ($errors->has('categories'))
                <span class="help-block text-danger">{{$errors->first('categories')}}</span>
            @endif
            </div>  
            <div class="form-grop{{$errors->has('users')?' has-error text-danger':''}}">
              <label for="users" class="control-label">Users</label>
              <select class="form-control select2" id="users" multiple="" name="users[]" style="width: 100%;" data-width="100%">
                <option value="">select</option>
                @foreach ($users as $user)
                      <option value="{{$user['email']}}">{{$user['email']}}</option>
                    @endforeach
              </select>
              @if ($errors->has('users'))
              <span class="help-block text-danger">{{$errors->first('users')}}</span>
          @endif
          </div> 
          <div class="form-grop{{$errors->has('amount')?' has-error text-danger':''}}">
            <label for="amount" class="control-label">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control" placeholder="enter amount">
            @if ($errors->has('amount'))
            <span class="help-block text-danger">{{$errors->first('amount')}}</span>
        @endif
        </div> 

          <div class="form-grop{{$errors->has('expirydate')?' has-error text-danger':''}}">
            <label for="expirydate" class="control-label">Expiry Date</label>
            <input type="text"name="expirydate" id="expirydate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>

            @if ($errors->has('expirydate'))
            <span class="help-block text-danger">{{$errors->first('expirydate')}}</span>
        @endif
        </div></div>
          </div>
        </div>
        <div class="card-footer">
         <button type="submit" class="btn btn-primary">Add Coupon</button>
        </div>
      </form>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection