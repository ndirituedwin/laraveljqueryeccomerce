<div class="tab-pane" id="listView">
    @foreach ($products as $product)
    <div class="row">
      <div class="span2">
          <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product['productimage']?>
                      @if (!empty($product['productimage']) && file_exists($smallpath))
                          <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product['productimage'])}}" alt="{{$product['productname']}}">
                     @else
                     <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product['productimage']}}">

                          @endif
      </div>
      <div class="span4">
          <h5>{{$product['productname']}}</h5>
          <h5>{{$product['brand']['brand']}}</h5>
          <p>
             {{$product['productdescription']}}
          </p>
          <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
          <br class="clr"/>
      </div>
      <div class="span3 alignR">
          <form class="form-horizontal qtyFrm">
              <h3>  {{$product['productprice']}}</h3>
             <label class="checkbox">
                  <input type="checkbox">  Adds product to compair
              </label><br/>
              
              <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
              <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
              
          </form>
      </div>
  </div>
 <hr class="soft">

    @endforeach
</div>