<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Sms;
use App\Models\User;
use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function getorders(){
        Session::put('page','orders');

        $userorders=Order::with('orders_products')->orderBy('id','DESC')->get()->toArray();
       //  dd($userorders);
        return view('admin.Orders.getorders')->withorders($userorders);
    }
    public function getsingleorder($orderid){

        $singleorder=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
//        $customerdetails=User::with('country')->where('id',$singleorder['user_id'])->first()->toArray();
        $customerdetails=User::with('country')->where('id',$singleorder['user_id'])->first();
   //    dd($singleorder);
        //dd("SS");
      //  dd($customerdetails);
        $orderlogs=OrdersLog::where('order_id',$orderid)->orderBy('id','DESC')->get()->toArray();
        $orderstatuses=OrderStatus::where('status',1)->get()->toArray();
     // dd($customerdetails);
        return view('admin.Orders.singleorder')
        ->withorderlogs($orderlogs)
        ->withcustomerdetails($customerdetails)
        ->withorderstatuses($orderstatuses)
        ->withorders($singleorder);
    }

    public function updateorderstatus(Request $request){
        if($request->isMethod('post')){
            $this->validate($request,[
                'order_id'=>'required',
                'order_status'=>'required',
            ]);
            //dd($request['couriername']);
            Session::put("orderid",$request['order_id']);
            Session::put("orderstatus",$request['order_status']);
            /**send order sms */
           Order::where('id',$request['order_id'])->update(['orderstatus'=>$request['order_status']]);
           if(!empty($request['couriername'])&& !empty($request['trackingnumber'])&& $request['order_status']=="Shipped"){
             //  dd($request['couriername']);
               Order::where('id',$request['order_id'])->update(['courier_name'=>$request['couriername'],'tracking_number'=>$request['trackingnumber']]);
           }
            $message="Heey customer! the status of your order number #".$request['order_id']." has been updated to ".$request['order_status'];
             $deliverydetailsss=Order::select('mobile','email','name')->where('id',$request['order_id'])->first()->toArray();
            $mobile=$deliverydetailsss['mobile'];
            Sms::sendsms($message,$mobile);
            /**send order email */
            $orderdetails=Order::with('orders_products')->where('id',$request['order_id'])->first()->toArray();
             $email=$deliverydetailsss['email'];
             $messagedata=[
                 "email"=>$email,
                 "name"=>$deliverydetailsss['name'],
                 "order_id"=>$request['order_id'],
                 "order_status"=>$request['order_status'],
                  "trackingnumber"=>$request['trackingnumber'],
                  "couriername"=>$request['couriername'],
                 "orderdetails"=>$orderdetails
             ];

             try {
                 Mail::send('Frontend.emails.orderstatus',$messagedata,function($message) use($email){
                $orderid=Session::get("orderid");
                $orderstatus=Session::get("orderstatus");
                $message->to($email)->subject("Heey customer! the status of your order number #".$orderid." has been updated to ".$orderstatus);
            });
            OrdersLog::create([
                'order_id'=>$request['order_id'],
                'order_status'=>$request['order_status'],
            ]);
            return redirect()->back()->withsuccess('order statuses updated successfully and user sent an email message');
            // return redirect()->route('admin.orders')->withsuccess('order statuses updated successfully and user sent an email message');

              } catch (\Throwable $th) {
                  return back()->withdanger("failed to update order status ".$th);
              }

        }
    }
    public function vieworderinvoice($orderid){
        $singleorder=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
        // dd($singleorder);
        $customerdetails=User::with('country')->where('id',$singleorder['user_id'])->first()->toArray();
       // dd($customerdetails);
        return view('admin.Orders.orderinvoice')
          ->withsingleorder($singleorder)
          ->withcustomerdetails($customerdetails);

    }
    function printorderinvoice($orderid){
        $singleorder=Order::with('orders_products')->where('id',$orderid)->first()->toArray();
        // dd($singleorder);
        $customerdetails=User::with('country')->where('id',$singleorder['user_id'])->first()->toArray();
 $output=
 '<!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>Example 2</title>

<style>

@font-face {
    font-family: SourceSansPro;
    src: url(SourceSansPro-Regular.ttf);
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  a {
    color: #0087C3;
    text-decoration: none;
  }

  body {
    position: relative;
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
  }

  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    float: left;
    margin-top: 8px;
  }

  #logo img {
    height: 70px;
  }

  #company {
    float: right;
    text-align: right;
  }


  #details {
    margin-bottom: 50px;
  }

  #client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    float: left;
  }

  #client .to {
    color: #777777;
  }

  h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
  }

  #invoice {
    float: right;
    text-align: right;
  }

  #invoice h1 {
    color: #0087C3;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
  }

  #invoice .date {
    font-size: 1.1em;
    color: #777777;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
  }

  table th,
  table td {
    padding: 20px;
    background: #EEEEEE;
    text-align: center;
    border-bottom: 1px solid #FFFFFF;
  }

  table th {
    white-space: nowrap;
    font-weight: normal;
  }

  table td {
    text-align: right;
  }

  table td h3{
    color: #57B223;
    font-size: 1.2em;
    font-weight: normal;
    margin: 0 0 0.2em 0;
  }

  table .no {
    color: #FFFFFF;
    font-size: 1.6em;
    background: #57B223;
  }

  table .desc {
    text-align: left;
  }

  table .unit {
    background: #DDDDDD;
  }

  table .qty {
  }

  table .total {
    background: #57B223;
    color: #FFFFFF;
  }

  table td.unit,
  table td.qty,
  table td.total {
    font-size: 1.2em;
  }

  table tbody tr:last-child td {
    border: none;
  }

  table tfoot td {
    padding: 10px 20px;
    background: #FFFFFF;
    border-bottom: none;
    font-size: 1.2em;
    white-space: nowrap;
    border-top: 1px solid #AAAAAA;
  }

  table tfoot tr:first-child td {
    border-top: none;
  }

  table tfoot tr:last-child td {
    color: #57B223;
    font-size: 1.4em;
    border-top: 1px solid #57B223;

  }

  table tfoot tr td:first-child {
    border: none;
  }

  #thanks{
    font-size: 2em;
    margin-bottom: 50px;
  }

  #notices{
    padding-left: 6px;
    border-left: 6px solid #0087C3;
  }

  #notices .notice {
    font-size: 1.2em;
  }

  footer {
    color: #777777;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #AAAAAA;
    padding: 8px 0;
    text-align: center;
  }


</style>

     </head>
   <body>
     <header class="clearfix">
       <div id="logo">
             <h1>Order Invoice</h1>
       </div>
      </header>
     <main>
       <div id="details" class="clearfix">
         <div id="client">
           <div class="to">INVOICE TO:</div>
           <h2 class="name">'.$singleorder['name'].'</h2>
           <div class="address">'.$singleorder['address'].','.$singleorder['city'].','.$singleorder['state'].'</div>
           <div class="address">'.$singleorder['country'].','.$singleorder['pincode'].'</div>
           <div class="email"><a href="#">'.$singleorder['email'].'</a></div>
         </div>
         <div style="float:right">
           <h1>Order Id: '.$singleorder['id'].'</h1>
           <div class="date">Order date '.date('F j, Y, g:i a',strtotime($singleorder['created_at'])).'</div>
           <div class="address">'.$singleorder['country'].','.$singleorder['pincode'].'</div>
           <div class="orderamount">Order amount:'.$singleorder['grandtotal'].' </div>
           <div class="orderstatus">Order status:'.$singleorder['orderstatus'].' </div>
           <div class="paymentmethod">Payment method:'.$singleorder['paymentmethod'].' </div>
           <div class="paymentgateway">Payment gateway:'.$singleorder['paymentgateway'].' </div>
         </div>
       </div>
       <table border="0" cellspacing="0" cellpadding="0">
         <thead>
           <tr>
             <th class="total">Product name</th>
             <th class="total">Product code</th>
             <th class="total">Size</th>
             <th class="total">Price</th>
             <th class="total">Color</th>
             <th class="total">Quantity</th>
             <th class="total">Total</th>
           </tr>
         </thead>
         <tbody>';
          if (!empty($singleorder)){
            $subtotal=0;

          foreach ($singleorder['orders_products'] as $order){
            $output.=' <tr>
            <td class="code">'.$order['product_name'].'</td>
            <td class="code">'.$order['product_code'].'</td>
            <td class="size">'.$order['product_size'].'</td>
            <td class="price">'.$order['product_price'].'</td>
            <td class="color">'.$order['product_color'].'</td>
            <td class="quantity">'.$order['product_quantity'].'</td>
            <td class="size">'.$order['product_price']*$order['product_quantity'].'</td>
          </tr>';
          }
          $subtotal=$subtotal+($order['product_price']*$order['product_quantity']);

        }
         $output.='
         </tbody>
         <tfoot>
           <tr>
             <td colspan="2"></td>
             <td colspan="2">SUBTOTAL</td>
             <td>'.$subtotal.'</td>
           </tr>';

            $output.='<tr>
             <td colspan="2"></td>
             <td colspan="2">Shipping charges</td>';
             if($singleorder['shippingcharges']>0){
               $output.=' <td>'.$singleorder['shippingcharges'].'</td>';
             }else{
                $output.=' <td>0</td>';
             }
           $output.='</tr>';
           $output.='<tr>
           <td colspan="2"></td>
           <td colspan="2">Coupon discount</td>';
           if($singleorder['couponamount']>0){
             $output.=' <td>'.$singleorder['couponamount'].'</td>';
           }else{
              $output.=' <td>0</td>';
           }
         $output.='</tr>

           <tr>
           <td colspan="2"></td>
           <td colspan="2">Grand total</td>
           <td>'.$singleorder['grandtotal'].'</td>
         </tr>
        </tfoot>
       </table>
       <div id="thanks">Thank you!</div>
       <div id="notices">
         <div>NOTICE:</div>
         <div class="notice">Thanks for placing the order</div>
       </div>
     </main>
     <footer>
      Thanks from zerooneten018@gmail.com
     </footer>
   </body>

   </html>';
      $dompdf = App::make('dompdf.wrapper');
        // $dompdf=new Dompdf();
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4','landscape');
        //$dompdf->render();
       return $dompdf->stream();

        //dd($customerdetails);
        // return view('admin.Orders.orderinvoice')
        //   ->withsingleorder($singleorder)
        //   ->withcustomerdetails($customerdetails);
    }


}