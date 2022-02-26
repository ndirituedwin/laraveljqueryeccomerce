<!DOCTYPE html>
 <html>
     <head>
         <title></title>
     </head>
     <body>
         <table style="width: 700px">
            <tr><td>&nbsp;</td></tr>
            <tr><td><img src="" alt=""></td></tr>
            <tr><td>Hi {{$first_name}}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Shukran for shopping with us, your order details are as below</td></tr>
            <tr>&nbsp;</tr>
            <tr><td>Order No: {{$order_id}}</td></tr>
            <tr>&nbsp;</tr>
            <tr>
                <td>
                    <table style="width: 95%" cellpadding="5" cellspacing="5"  color="white">
                           <tr style="background-color: #cccccc">
                            <td>Product Name</td>
                            <td>Product Code</td>
                            <td>Product Size</td>
                            <td>Product Color</td>
                            <td>Product Quantity</td>
                            <td>Product Price</td>
                        </tr>
                        @foreach ($orderdetails['orders_products'] as $order)
                             <tr style="background-color: #cccccc">
                                <td>{{$order['product_name']}}</td>
                                <td>{{$order['product_code']}}</td>
                                <td>{{$order['product_size']}}</td>
                                <td>{{$order['product_color']}}</td>
                                <td>{{$order['product_quantity']}}</td>
                                <td>Ksh.{{$order['product_price']}}</td>
                            </tr>
                          
                        @endforeach
                          <tr>
                                <td colspan="5" align="right">Shipping charges</td>
                                 <td>Kshs{{$orderdetails['shippingcharges']}}</td>  
                            </tr>
                            <tr>
                                <td colspan="5" align="right">Coupon Discount</td>
                                <td>Kshs. {{$orderdetails['couponamount']}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right">Grand Total</td>
                                <td>Kshs. {{$orderdetails['grandtotal']}}</td>
                            </tr>
                    </table>
                </td>
            </tr><tr><td>&nbsp;</td></tr>
            <tr><td>
              <table>
                     <tr>
                    <td><strong>Delivery Address</strong></td>     
                    </tr>      
                    <tr>
                        <td>Name: {{$orderdetails['name']}}</td>
                    </tr>
                    <tr>
                        <td>Address:{{$orderdetails['address']}}</td>
                    </tr>
                    <tr>
                        <td>City:{{$orderdetails['city']}}</td>
                    </tr>
                    <tr>
                        <td>State:{{$orderdetails['state']}}</td>
                    </tr>
                    <tr>
                        <td>Country:{{$orderdetails['country']}}</td>
                    </tr>
                    <tr>
                        <td>Pincode:{{$orderdetails['pincode']}}</td>
                    </tr>
                    <tr>
                        <td>Mobile:{{$orderdetails['mobile']}}</td>
                    </tr>
            </table>    
            
            </td></tr>
            <tr><td>For any queries contact as at  <a href="<? /* mailto:ndiritu.edwin018@gmail.com */ ?>">myamazon.com</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Regards <br>My amazon team</td></tr>
            <tr><td>&nbsp;</td></tr>
         </table>
     </body>
 </html>