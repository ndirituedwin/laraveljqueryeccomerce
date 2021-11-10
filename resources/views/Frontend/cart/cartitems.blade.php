<?php
 use App\Models\Cart;
 use App\Models\Product;
?>
<table class="table table-bordered">
    <thead>

      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Quantity/Update</th>
        <th>Price</th>
        <th>Pro/cat/Discount</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
        @if (!empty($cartitems))
        <?php $totalprice=0;?>
        @foreach ($cartitems as $cartitem)
        <?php
        $productattributeprice=Product::getdiscountedattrprice($cartitem['product_id'],$cartitem['size']);
        ?>
        <tr>
          <td>

            @if (!empty($cartitem['product']['productimage']))
              <img src="{{asset('adminlte/adminimages/images/adminproducts/small/'.$cartitem['product']['productimage'])}}">


                  @endif
                           </td>
          <td>{{((isset($cartitem['product']['productname'])?$cartitem['product']['productname']:''))}}
              <br/>Color:{{(isset($cartitem['product']['productcolor'])?$cartitem['product']['productcolor']:'')}}
          <br/>Size:{{(isset($cartitem['size'])?$cartitem['size']:'')}}
          </td>
          <td>
            <div class="input-append" id="appedninpu">

              {{-- <input class="span1" style="max-width:34px" value="{{$cartitem['quantity']}}"  id="appendedInputButtons" size="16" type="text"> --}}
              <input class="span1" style="max-width:34px" value="{{$cartitem['quantity']}}"  id="appendedInputButtons" size="16" type="text">
              <button class="btn btnItemUpdate qtyMinus"  type="button" data-cartid="{{$cartitem['id']}}"><i class="icon-minus"></i></button>
                <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$cartitem['id']}}"><i class="icon-plus"></i></button>
                <button class="btn btn-danger btnItemDelete"  record="cartitem" recordid="{{$cartitem['id']}}" data-cartid="{{$cartitem['id']}}" type="button"><i class="icon-remove icon-white"></i></button>
                </div>
          </td>
          <td>Kshs/={{$productattributeprice['productprice']*$cartitem['quantity']}}</td>
          <td>{{$productattributeprice['discount']*$cartitem['quantity']}}</td>
          <td>Kshs/={{($productattributeprice['discounted_price']) * ($cartitem['quantity'])}}</td>
        </tr>
        <?php $totalprice=$totalprice+( $productattributeprice['discounted_price'] * $cartitem['quantity'] )?>
        @endforeach

        @endif



      <tr>
        <td colspan="6" style="text-align:right">Total Price:	</td>
        <td>Kshs/={{$totalprice}}</td>
      </tr>
       <tr>
        {{-- <td colspan="6" style="text-align:right">Coupon Discount:	</td> --}}
        {{-- <td class="couponamount">
            @if (Session::has('couponamount'))
                 -Ksh.{{Session::get('couponamount')}}
                 @else
                 Ksh.0
             @endif


        </td> --}}
      </tr>

       <tr>
        <td colspan="6" style="text-align:right"><strong>Grand TOTAL (Kshs {{$totalprice}}-<span class="couponamount">Kshs</span>)=</strong></td>

        <td class="label label-important" style="display:block"> <strong class="grand_total">Ksh:/={{$totalprice-Session::get('couponamount')}}</strong></td>
      </tr>
      </tbody>
  </table>
