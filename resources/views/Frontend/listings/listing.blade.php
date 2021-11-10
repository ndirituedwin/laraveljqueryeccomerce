<?php Use App\Models\Product;?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')

<div class="span9">
  <ul class="breadcrumb">
    <li><a href="/">Home</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $categorydetails['breadcrumbs'];?></li>
  </ul>
  <h3> {{$categorydetails['catdetails']['categoryname']}} <small class="pull-right" style="color: crimson"> {{count($products)}} {{Str::plural('product',count($products))}}  available </small></h3>
  <hr class="soft"/>
  <p>
    {{$categorydetails['catdetails']['description']}}
  </p>
  @if (!isset($_REQUEST['search']))
  <hr class="soft"/>
  <form class="form-horizontal span6" name="sortProducts" id="sortProducts" >
    <input type="hidden" name="slug" id="slug" value="{{$slug}}">
    <div class="control-group">
      <label class="control-label alignL">Sort By </label>
      <select name="sort" id="sort">
        <option value="">Select</option>
        <option value="latestproducts" @if (@isset($_GET['sort']) && $_GET['sort']=="latestproducts") selected=""
        @endif>Latest Products</option>
        <option value="atoz" @if (@isset($_GET['sort'])&& $_GET['sort']=="atoz") selected=""
        @endif>Product name A-z</option>
        <option value="ztoa" @if (@isset($_GET['sort'])&& $_GET['sort']=="ztoa")
            selected=""
            @endif>Product name Z-A</option>
        <option value="lowestpice" @if (@isset($_GET['sort'])&& $_GET['sort']=="lowestprice")
        selected="")@endif> Lowest Price first</option>
        <option value="highestprice" @if (@isset($_GET['sort'])&& $_GET['sort']=="highestprice")
        selected=""
        @endif> Highest Price first</option>
      </select>
    </div>
  </form>
  @endif

  <br class="clr"/>
  <div class="tab-content filteproducts">

   @include('Frontend.listings.ajaxproductlisting')
  </div>
  @if (!isset($_REQUEST['search']))
  <div class="pagination">
    @if (isset($_GET['sort'])&& ! empty($_GET['sort']))
    {{$products->appends(['sort'=>$_GET['sort']])->links()}}
    @else
    {{$products->links()}}

    @endif
    {{-- {{$products->appends(['sort'=>'price_lowest'])->links()}} --}}
  </div>
  @endif
  <br class="clr"/>
</div>

@endsection
