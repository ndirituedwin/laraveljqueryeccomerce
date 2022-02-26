<div class="tab-pane" id="listView">
    @if (!empty($relatedproducts))
        @foreach ($relatedproducts as $product)
        <div class="row">
            <div class="span2">

                <?php $smallpath='adminlte/adminimages/images/adminproducts/small/'.$product['productimage']?>
                @if (!empty($product['productimage']) && file_exists($smallpath))
                    <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$product['productimage'])}}" alt="{{$product['productname']}}">
               @else
               <img src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$product['productimage']}}">

                    @endif                                    </div>
      
        </div>
        <hr class="soft"/>
        @endforeach
    @endif
</div>

<div class="span4">
    <h3>New | Available</h3>
    <hr class="soft"/>
    <h5>{{$product['productname']}} </h5>
    <h5>{{$product['productcode']}} </h5>
    <p>
      {{$product['productdescription']}}
    </p>
    <a class="btn btn-small pull-right" href="{{ route('singlepro.getdetails',$product['slug']) }}">View Details</a>
    <br class="clr"/>
</div>
<div class="span3 alignR">
    <form class="form-horizontal qtyFrm">
        <h3> Rs.1000</h3>
        <label class="checkbox">
            <input type="checkbox">  Add products to compare
        </label><br/>
        <div class="btn-group">
            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
        </div>
    </form>
</div>