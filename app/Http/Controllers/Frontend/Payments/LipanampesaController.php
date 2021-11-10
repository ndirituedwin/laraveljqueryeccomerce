<?php

namespace App\Http\Controllers\Frontend\Payments;

use App\Models\Order;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LipanampesaController extends Controller
{
    public function lipanampesa(){

        // dd(Session::get('order_id'));
         if(Session::has('order_id')){
             //Cart::where('user_id',Auth::user()->id)->delete();
              $getsections=Section::with('categories')->where('status',1)->get();
              $orderdetails=Order::where('id',Session::get('order_id'))->first()->toArray();
             //  $fullnamearray=explode(' ',$orderdetails['name']);
             //  if(!empty($fullnamearray[0])){
             //     $firstname=$fullnamearray[0];
             //  }
              
             // dd($orderdetails);
             // dd($orderdetails);
              return view('Frontend.deliveyaddress.lipanampesa.lipanampesa')
              ->withorderdetails($orderdetails)
              //->withfullname($fullname)
              ->withsections($getsections)->withsuccess('Order successfully placed');
              }
     }
     public function getaccesstoken(){

      $consumer_key ="yYyFk5Gy2lt0iMpVNmbZvdGGRUlcN3hd";
      $consumer_secret = "rFuAysextQxHuCCK";
      $credentials = base64_encode($consumer_key.":".$consumer_secret);
      
      $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $curl_response = curl_exec($curl);

      $access_token = json_decode($curl_response);

      return $access_token->access_token;
      //   echo "<pre>";print_r("Dd");die;


        //  $consumer_key ="yYyFk5Gy2lt0iMpVNmbZvdGGRUlcN3hd";
        //  $consumer_secret = "rFuAysextQxHuCCK";
        //  $credentials = base64_encode($consumer_key.":".$consumer_secret);
  
        //  $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
   
        //  $curl = curl_init();
        //  curl_setopt($curl, CURLOPT_URL, $url);

        //  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        //  curl_setopt($curl, CURLOPT_HEADER, false);
        //  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
        //  $curl_response = curl_exec($curl);
   
        //  $access_token = json_decode($curl_response);
 
        //  return $access_token->access_token;





        //    $url=env('MPESA_ENV')==0
        //     ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        //     :'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        //     $curl=curl_init($url);
        //     curl_setopt_array(
        //         $curl,
        //         array(
        //           CURLOPT_HTTPHEADER=>['content-Type: application/json; charset=utf8'],
        //           CURLOPT_RETURNTRANSFER=>true,
        //           CURLOPT_HEADER=>false,
        //           CURLOPT_USERPWD=>env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')

        //         )
        //         );
        //         //$response=json_decode(curl_exec($curl));
        //         $response=curl_exec($curl);
        //         curl_close($curl);
        //         return $response;
     }

     public function getmpesaaccesstoken(){
            //   $url=env('MPESA_ENV')==0
            // ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            // :'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';     
            $curl=curl_init($url);
         //   $credentials = base64_encode($consumer_key.":".$consumer_secret);

            curl_setopt_array(
                $curl,
                array(
                  CURLOPT_HTTPHEADER=>['content-Type: application/json; charset=utf8'],
                  CURLOPT_RETURNTRANSFER=>true,
                  CURLOPT_HEADER=>false,
                  CURLOPT_USERPWD=>env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')

                )
                );
                //$response=json_decode(curl_exec($curl));
                $response=json_decode(curl_exec($curl));
                curl_close($curl);
                return $response->access_token;

     }


     public function stkpush(){
      $BusinessShortCode = 174379;
      $passkey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
      $timestamp= Carbon::rawParse('now')->format('YmdHms');

      $password = base64_encode($BusinessShortCode.$passkey.$timestamp);
      $Amount= 1;
      $PartyA = 254799149758;
      $PartyB = 174379;


      $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
      
      
      $curl_post_data = array(
        //Fill in the request parameters with valid values
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount"' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $PartyB,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => 'http://658f04bcddab.ngrok.io/LIPA-NA-MPESA/',
        'AccountReference' => 'CodeXcellent Education ',
        'TransactionDesc' => 'Testing stkpush on Sandbox '
      );
      
      $data_string = json_encode($curl_post_data);
      
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      
      $curl_response = curl_exec($curl);
      
      
      return $curl_response;
    //   $BusinessShortCode =174379;
    //   $passkey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    //   $timestamp= Carbon::rawParse('now')->format('YmdHms');
    //   $password = base64_encode($BusinessShortCode.$passkey.$timestamp);
    //   $Amount= 1;
    //   $PartyA = 254799149758;
    //   $PartyB = 174379;

      
    //  $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    //   //$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
    //   //return $url;

    //   $curl = curl_init();
    //   curl_setopt($curl, CURLOPT_URL, $url);
    //   curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
      
      
    //   $curl_post_data = array(
    //     //Fill in the request parameters with valid values
    //     'BusinessShortCode' => $BusinessShortCode,
    //     'Password' => $password,
    //     'Timestamp' => $timestamp,
    //     'TransactionType' => 'CustomerPayBillOnline',
    //     'Amount"' => $Amount,
    //     'PartyA' => $PartyA,
    //     'PartyB' => $PartyB,
    //     'PhoneNumber' => $PartyA,
    //     'CallBackURL' => ' http://ddfa63e67d6b.ngrok.io/LIPA-NA-MPESA/',
    //     'AccountReference' => 'laravel eccormerce ',
    //     'TransactionDesc' => 'Testing stkpush on Sandbox '
    //   );
      
    //   $data_string = json_encode($curl_post_data);
      
    //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //   curl_setopt($curl, CURLOPT_POST, true);
    //   curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      
    //   $curl_response = curl_exec($curl);
      
      
    //   return $curl_response;
     }
    public function stkkpush(){


      date_default_timezone_set('Africa/Nairobi');

  # access token
  $consumerKey = '33XXFr30oYHOsEa6yT5tBvxBi532OfJB'; //Fill with your app Consumer Key
  $consumerSecret = 'ARcGX5DGGophsuRP'; // Fill with your app Secret

  # define the variales
  # provide the following details, this part is found on your test credentials on the developer account
  $Amount = 1;
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
  //$PartyA = $_GET['phone']; // This is your phone number, 
  $PartyA = 254799149758; // This is your phone number, 
  $AccountReference = 'Codestarshop';
  $TransactionDesc = 'test';
  
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
 // $CallBackURL = 'https://ericobanks.codestar.co.ke/callback_url.php';  
 //$CallBackURL = 'https:// http://ddfa63e67d6b.ngrok.io/LIPA-NA-MPESA';  
 $CallBackURL = 'https://658f04bcddab.ngrok.io/LIPA-NA-MPESA/';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  //return $access_token;
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
   return $curl_response;
    }



}
