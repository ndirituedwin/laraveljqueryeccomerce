<?php
  use App\Models\Product;
?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{$featuredproducts}} featured products</small></h4>
        <div class="row-fluid">
            
                
            <div id="featured" @if ($featuredproducts>4) class="carousel slide" @endif>
                <div class="carousel-inner">
                    @if (!empty($featuredproductsschunk))
                        @foreach ($featuredproductsschunk as $key=> $featureditem)
                    <div class="item @if($key==1) active @endif">
                        <ul class="thumbnails">
                          @if (!empty($featureditem))
                              @foreach ($featureditem as $item)
                              <li class="span3">
                                <div class="thumbnail">
                                    <a href="{{ route('singlepro.getdetails',$item['slug']) }}">

                                    <i class="tag"></i>
                                    <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$item['productimage']?>
                                    @if (!empty($item['productimage']) && file_exists($smallpath))
                                        <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$item['productimage'])}}" alt="{{$item['productimage']}}">
                                   @else
                                   <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$item['productimage']}}">
      
                                        @endif
                                    <div class="caption">
                                        <h5>{{$item['productname']}}</h5>
                                        <?php $productdicountedprice=Product::getdiscountedprice($item['id'])?>

                                        <h4><a class="btn" href="{{ route('singlepro.getdetails',$item['slug']) }}">VIEW</a> <span class="pull-right" style="font-size: 12px">
                                            @if ($productdicountedprice>0)
                                     <del>Ksh/={{$item['productprice']}}</del>
                                     Ksh/={{$item['productprice']}}
                                     @else
                                     <?php /*<font color="red">Ksh/={{$item['productprice']}}</font>*/ ?>

                                             @endif
                                        </span></h4>
                                        @if ($productdicountedprice>0)
                                        <h6><font color="red">Discounted price:{{$productdicountedprice}}</font></h6>
                                            
                                        @endif
                                    </div>
                                       </a>
  
                                </div>
                            </li>
                              @endforeach
                              
                          @endif
                          
                          
                            
                        </ul>
                    </div>
                       @endforeach
                    @endif
                    
                </div>
               <!-- <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>-->
            </div>

        </div>
    </div>
    <h4>Latest Products </h4>
    @include('layouts.adminlayout.adminpartials.alertss')

    <ul class="thumbnails" >
        @if (!empty($latestproducts))
            @foreach ($latestproducts as $featured)
        <li class="span3"  >
            <div class="thumbnail" style="height: 400px;background-color: khaki">
                <a  href="{{ route('singlepro.getdetails',$featured['slug']) }}">
                    <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$featured['productimage']?>
                    @if (!empty($featured['productimage']) && file_exists($smallpath))
                        <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$featured['productimage'])}}" alt="{{$featured['productimage']}}">
                   @else
                   <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$featured['productimage']}}">

                        @endif
           </a>
                <div class="caption">
                    <h5>{{$featured['productname']}}</h5>
                    <p>
                      <b> Product code</b>: {{$featured['productcode']}}
                    </p>
                    <p>
                        {{$featured['productdescription']}}
                    </p>
                    <?php $productdicountedprice=Product::getdiscountedprice($featured['id'])?>

                    <h4 style="text-align:center">
                        <a  class="btn btn-danger"  href="{{ route('singlepro.getdetails',$featured['slug']) }}">View Details</a>
                    </h4>

                    <h4 style="text-align:center">
                        <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                            @if ($productdicountedprice > 0)
                            <del>Kshs{{$featured['productprice']}}</del>
                            <font color="yellow">Kshs{{$featured['productprice']}}</font>
                                @else
                                {{$featured['productprice']}}
                            @endif
                        </a></h4>
                        @if ($productdicountedprice>0)                               
                         <center>
                            <font color="red">Discounted price:{{$productdicountedprice}}</font>
                                                 </center>
                        @endif
                </div>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
@endsection