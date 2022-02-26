<?php
use App\Models\Product;
?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ route('frontend.index') }}">Home</a> <span class="divider">/</span></li>
        <li><a href="{{ route('category.products',$product['category']['slug']) }}">{{$product['category']['categoryname']}}</a> <span class="divider">/</span></li>
        <li class="active">{{$product['productname']}}</li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">
            <a href="{{asset('adminlte/adminimages/images/adminproducts/large/'.$product['productimage'])}}" title="{{$product['productname']}}">
                <img src="{{asset('adminlte/adminimages/images/adminproducts/large/'.$product['productimage'])}}" style="width:100%" alt="{{$product['productname']}}"/>
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        @if (!empty($product['productimages']))
                        @foreach ($product['productimages'] as $productimages)
                        <a href="{{asset('adminlte/adminimages/images/adminproducts/large/'.$productimages['image'])}}"> <img style="width:29%" src="{{asset('adminlte/adminimages/images/adminproducts/large/'.$productimages['image'])}}" alt=""/></a>
                        @endforeach
                        @else
                        <span>This Product Does Not have other images</span>
                        @endif
                             </div>
                    <div class="item">
                        @if (!empty($product['productimages']))
                         @foreach ($product['productimages'] as $productimages)
                         <a href="{{asset('adminlte/adminimages/images/adminproducts/large/'.$productimages['image'])}}"> <img style="width:29%" src="{{asset('adminlte/adminimages/images/adminproducts/large/'.$productimages['image'])}}" alt=""/></a>
                         @endforeach
                         @else
                         <span>This product does not have other image</span>
                        @endif
                      </div>
                </div>
                <!--
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                -->
            </div>
        </div>

        <div class="span6">
            <h3>{{$product['productname']}}  </h3>
            <small>{{$product['brand']['brand']}}</small>
            <hr class="soft"/>
            <small >{{$sumofstock}} items in stock</small>

            @include('layouts.adminlayout.adminpartials.alertss')
            @if (count($groupproducts)>0)
            <div class="panel" >
                 <div class="panel-heading"><strong>More Colors</strong></div>
                 <div>
                     @foreach ($groupproducts as $item)
                     <a href="{{ route('singlepro.getdetails',$item['slug']) }}">

                         <img style="height: 100px;width: 70px;" src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$item['productimage'])}}" alt="{{$item['productname']}}">
                     </a>
                     @endforeach
                 </div>
             </div>

            @endif
            <form action="{{ route('addproduct.tocart') }}" method="post" class="form-horizontal qtyFrm">
              @csrf
                <input type="hidden" name="productid" value="{{$product['id']}}">
               <input type="hidden" name="slugg" value="{{$product['slug']}}">
                <div class="control-group">
                    <?php $discountedprice=Product::getdiscountedprice($product['id'])?>

                    <h4  class="getattributeprice">
                        @if ($discountedprice > 0)
                        <b style="color: hotpink">Discounted price Kshs/=:{{$discountedprice}}</b><br>
                        <del>Kshs/={{$product['productprice']}}</del>
                            @else
                            {{$product['productprice']}}
                        @endif
                       </h4>
                        <select  class="span2 pull-left" name="size" id="getsize" product_id="{{$product['id']}}" slug="{{$product['slug']}}">
                            <option value="">Select</option>
                            @if (!empty($product['attributes']))
                            @foreach ($product['attributes'] as $attribute)
                            <option value="{{$attribute['size']}}">{{$attribute['size']}}</option>

                            @endforeach
                            @endif


                        </select>

                        <input type="number"  name="quantity" class="span1" placeholder="Qty." />
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                       <div style="margin-top: 5%">
                        <label for="deliver">Enter delivery pincode</label>
                        <input type="text"  name="delievrypincode" id="enterpincode"  placeholder="test"/>
                        <button type="button" class="btn btn-sm bg-transparent" id="checkpincode">Check</button>
                       </div>

                    </div>
                </div>

            </form>

                {{-- <label for="delivery"  ><span style="margin-left: 10px">Enter delivery pincode</span></label>
                <input type="text"  style="margin-left: 10px" name="delievrypincode" id="enterpincode"  placeholder="test"/>
                <button class="btn btn-sm bg-transparent" id="checkpincode">Check</button> --}}



            <hr class="soft clr"/>
            <p class="span6">
               {{$product['productdescription'] }}
            </p>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>


        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content" style="background-color: chocolate">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered table-condensed table-responsive table-hover">
                        <tbody>
                            <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$product['brand']['brand']}}</td></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$product['productcode']}}</td></tr>
                            @if (!empty($product['productcolor']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{$product['productcolor']}}</td></tr>
                            @endif
                            @if (!empty($product['fabric']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$product['fabric']}}</td></tr>
                            @endif
                            @if (!empty($product['pattern']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{$product['pattern']}}</td></tr>

                            @endif
                            @if (!empty($product['sleeve']))
                            <tr class="techSpecRow"><td class="techSpecTD1">sleeve:</td><td class="techSpecTD2">{{$product['sleeve']}}</td></tr>
                            @endif
                            @if (!empty($product['fit']))
                            <tr class="techSpecRow"><td class="techSpecTD1">fit:</td><td class="techSpecTD2">{{$product['fit']}}</td></tr>
                            @endif
                            @if (!empty($product['occassion']))
                            <tr class="techSpecRow"><td class="techSpecTD1">occassion:</td><td class="techSpecTD2">{{$product['occassion']}}</td></tr>
                            @endif
                            @if (!empty($product['washcare']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Washcare:</td><td class="techSpecTD2">{{$product['washcare']}}</td></tr>
                            @endif



                        </tbody>
                    </table>


                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"></a>
                        <a href="#blockView" data-toggle="tab"></a>
                    </div>
                    <br class="clr"/>
                    <hr class="soft"/>
                    <div class="tab-content">

                        <div class="tab-pane active" id="blockView" >
                            <ul class="thumbnails">
                                @if (!empty($relatedproducts))
                                @foreach ($relatedproducts as $product)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="{{ route('singlepro.getdetails',$product['slug']) }}">

                    <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product['productimage']?>
                    @if (!empty($product['productimage']) && file_exists($smallpath))
                        <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product['productimage'])}}" alt="{{$product['productname']}}">
                   @else
                   <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product['productimage']}}">

                        @endif
                                        </a>
                                        <div class="caption">
                                            <h5>{{$product['productname']}}</h5>
                                            <p>
                                               {{$product['productdescription']}}
                                            </p>
                                            <h4 style="text-align:center"><a class="btn btn-primary" href="#">Ksh/={{$product['productprice']}}</a></h4>
                                        </div>
                                    </div>
                                </li>

                                @endforeach
                                 @endif

                            </ul>
                            <hr class="soft"/>
                        </div>

                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
@endsection
