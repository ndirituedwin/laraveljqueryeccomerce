<div id="sidebar" class="span3" style="height: 700px;overflow: scroll;" >
    <div class="well well-small"><a id="myCart" href="{{ route('cart.show') }}"><img src="{{asset('frontend/themes/images/ico-cart.png')}}" alt="cart"><span class="ttcartitems">{{TotalCartItems()}}{{Str::plural('item',TotalCartItems())}}</span> in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked" style="background-color: crimson">
      @if (!empty($sections))
      @foreach ($sections as $section)
      <li class="subMenu"><a>{{$section->section}}</a>
         @if (!empty($section->categories))
             @foreach ($section->categories as $category)
             <ul>
                <li><a href="{{ route('category.products',$category) }}"><i class="icon-chevron-right"></i><b>{{$category->categoryname}}</b></a></li>
                   </ul>
             @endforeach
         @endif
         @if (!empty($category->subcategories))
             @foreach ($category->subcategories as $subcategory)
             <ul>
                <li><a href="{{ route('category.products',$subcategory) }}"><i class="icon-chevron-right"></i>&nbsp;&raquo;{{$subcategory->categoryname}}</a></li>
                      </ul>
             @endforeach
         @endif
      </li>
      @endforeach
      @endif

    </ul>
    <br>

    @if (isset($listing) && $listing=="listing" &&  !isset($_REQUEST['search']))
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach ($fabrics as $fabric)
                <input class="fabric" type="checkbox" name="fabric[]" id="{{$fabric}}" value="{{$fabric}}">&nbsp;{{$fabric}}
                <br>
            @endforeach <hr>        </div>

            <div class="well well-small">

            <h5>pattern</h5>
            @foreach ($patterns as $pattern)
                <input  class="pattern" type="checkbox" name="pattern[]" id="{{$pattern}}" value="{{$pattern}}">&nbsp;{{$pattern}}
                <br>
            @endforeach <hr>
        </div>

            <div class="well well-small">

            <h5>sleeves</h5>
            @foreach ($sleeves as $sleeve)
                <input  class="sleeve" type="checkbox" name="sleeve[]" id="{{$sleeve}}" value="{{$sleeve}}">&nbsp;{{$sleeve}}
                <br>
            @endforeach <hr>
        </div>

            <div class="well well-small">

            <h5>fit</h5>
            @foreach ($fits as $fit)
                <input class="fit" type="checkbox" name="fit[]" id="{{$fit}}" value="{{$fit}}">&nbsp;{{$fit}}
                <br>
            @endforeach <hr style="background-color: green">
        </div>

            <div class="well well-small">

            <h5>occassion</h5>
            @foreach ($occassions as $occassion)
                <input class="occassion" type="checkbox" name="occassion[]" id="{{$occassion}}" value="{{$occassion}}">&nbsp;{{$occassion}}
                <br>
            @endforeach
        </div>
    @endif

</div>
