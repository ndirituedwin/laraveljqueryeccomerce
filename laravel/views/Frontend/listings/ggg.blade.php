<div class="tab-pane" id="listView">
    @if (count($products)>0)
    @foreach ($products as $product)    
    <div class="row">
      <div class="span2">
       <a href="{{ route('singlepro.getdetails',$product['slug']) }}">
         <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product['productimage']?>
         @if (!empty($product['productimage']) && file_exists($smallpath))
             <img  style="width: 100px;height: 200px" src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product['productimage'])}}" alt="{{$product['productimage']}}">
        @else
        <img style="width: 100px;height:200px" src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product['productimage']}}">

             @endif
       </a>
      </div>
      <div class="span4">
        <h3>{{$product['productname']}}</h3>
        <hr class="soft"/>
          <p>
            <b style="color: green">Brand:</b>  {{$product['brand']['brand']}}
          </p>
                 {{$product['productdescription']}}
         
        </p>
        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
        <br class="clr"/>
      </div>
      <div class="span3 alignR">
        <form class="form-horizontal qtyFrm">
          <h3> {{$product['productprice']}}</h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br/>
          
          <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
          <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
          
        </form>
      </div>
    </div>
    <hr class="soft"/>
    @endforeach
        
    @else
    <center>
     <span style="color: red">No products available</span>
   </center>
    @endif
   </div>
   <div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
    @if (count($products)>0)
    @foreach ($products as $product)
    <li class="span3" >
     <div class="thumbnail" >
       <a href="{{ route('singlepro.getdetails',$product['slug']) }}" >
         <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product['productimage']?>
         @if (!empty($product['productimage']) && file_exists($smallpath))
             <img  style="width: 100px;height: 200px" src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product['productimage'])}}" alt="{{$product['productimage']}}">
        @else
        <img style="width: 100px;height:200px" src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product['productimage']}}">

             @endif
                     </a>
       <div class="caption">
         <h5>{{$product['productname']}}</h5>
         <p>
         <b style="color: green">Brand:</b>  {{$product['brand']['brand']}}
         </p>
         <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
       </div>
     </div>
   </li>
    @endforeach
    @else
    <center>
      <span style="color: red">No products available</span>
    </center>
    @endif
     
    </ul>
    <hr class="soft"/>
  </div>











  <div id="myTab" class="pull-right">
    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
  </div>