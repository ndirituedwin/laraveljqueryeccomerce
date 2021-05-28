<?php
use App\Models\Product;
?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
      @foreach ($products as $product)
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
                       {{$product['brand']['brand']}}
                    </p>
                    <?php $discountedprice=Product::getdiscountedprice($product['id'])?>
                    <h4 style="text-align:center">
                        <a  class="btn btn-danger"  href="{{ route('singlepro.getdetails',$product) }}">View Details</a>
                    </h4>
                    <h4 style="text-align:center"><a class="btn" href="{{ route('singlepro.getdetails',$product) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
                        <a class="btn btn-primary" href="#">
                           @if ($discountedprice > 0)
                           <del>Kshs/={{$product['productprice']}}</del>
                               @else
                               {{$product['productprice']}}
                           @endif 
                        </a>
                    </h4>
                    @if ($discountedprice>0)
                    <center>
                <h4 style="background-color: green;color: hotpink;border-radius: 5px 5px 5px;" >Discounted price:{{$discountedprice}}</h4>
                    </center>
                    @endif 
                  <?php /*  <p>
                        {{$product['fabric']}}
                    </p>
                    <p>
                        {{$product['sleeve']}}
                    </p>
                    <p>
                        {{$product['pattern']}}
                    </p>
                    <p>
                        {{$product['fit']}}
                    </p>
                    <p>
                        {{$product['occassion']}}
                    </p> */ ?>
                </div>
               
            </div>
        </li>  
      @endforeach               
    </ul>
    <hr class="soft"/>
</div>