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
        <form action="{{ route('coupon.edit',$coupon['id']) }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="couponoption" value="{{$coupon['couponoption']}}" >
        <input type="hidden" name="couponcode" value="{{$coupon['couponcode']}}" >
          <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group{{$errors->has('couponoption')?' has-error text-danger':''}}">
                  <label for="couponoption" class="control-label">Coupon option: <i class="text-danger">{{$coupon['couponcode']}}</i> </label><br>
                </div>           
               
                <div class="form-group{{$errors->has('coupontype')?' has-error text-danger':''}}">
                  <label for="coupontype" class="control-label">Add coupon type</label><br>
                  <span><input  type="radio"  name="coupontype" value="multiple times" @if (isset($coupon['coupontype'])&&$coupon['coupontype']=="multiple times")
                    checked 
                  @endif>multiple times
                    &nbsp;&nbsp;
                    <span><input  type="radio"  name="coupontype" value="single times" @if (isset($coupon['coupontype'])&&$coupon['coupontype']=="single times")
                        checked 
                      @endif>single times
                      &nbsp;&nbsp; @if ($errors->has('coupontype'))
                      <span class="help-block text-danger">{{$errors->first('coupontype')}}</span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('amounttype')?' has-error text-danger':''}}">
                  <label for="amounttype" class="control-label">Amount type</label><br>
                  <span><input  type="radio" checked name="amounttype" value="percentage"@if (isset($coupon['amounttype'])&&$coupon['amounttype']=="percentage")
                    checked 
                  @endif >percentage(%)
                    &nbsp;&nbsp;
                    <span><input  type="radio" name="amounttype" value="fixed" @if (isset($coupon['amounttype'])&&$coupon['amounttype']=="fixed")
                        checked 
                      @endif>fixed
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
                      <optgroup label="{{$section['section']}}"></optgroup>
                      @foreach ($section['categories'] as $category)
                      <option value="{{$category['id']}}" @if (in_array($category['id'],$selectcats))
                          selected
                      @endif  style="background-color: green"> &raquo;{{$category['categoryname']}}</option>
                      @if (!empty($category['subcategories']))
                          @foreach ($category['subcategories'] as $subcategory)
                          <option value="{{$subcategory['id']}}" @if (in_array($subcategory['id'],$selectcats))
                              selected
                          @endif style="background-color: rgb(9, 0, 128)"> &nbsp; &nbsp; &nbsp;&raquo;{{$subcategory['categoryname']}}</option>       
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
                      <option value="{{$user['email']}}" @if (in_array($user['email'],$selectusers))
                      selected
                  @endif>{{$user['email']}}</option>
                    @endforeach
              </select>
              @if ($errors->has('users'))
              <span class="help-block text-danger">{{$errors->first('users')}}</span>
          @endif
          </div> 
          <div class="form-grop{{$errors->has('amount')?' has-error text-danger':''}}">
            <label for="amount" class="control-label">Amount</label>
            <input type="text" name="amount" value="{{$coupon['amount']}}" id="amount" class="form-control" placeholder="enter amount">
            @if ($errors->has('amount'))
            <span class="help-block text-danger">{{$errors->first('amount')}}</span>
        @endif
        </div> 

          <div class="form-grop{{$errors->has('expirydate')?' has-error text-danger':''}}">
            <label for="expirydate" class="control-label">Expiry Date</label>
            <input type="text"name="expirydate" value="{{$coupon['expirydate']}}" id="expirydate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>

            @if ($errors->has('expirydate'))
            <span class="help-block text-danger">{{$errors->first('expirydate')}}</span>
        @endif
        </div></div>
          </div>
        </div>
        <div class="card-footer">
         <button type="submit" class="btn btn-primary">Updated Coupon</button>
        </div>
      </form>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection