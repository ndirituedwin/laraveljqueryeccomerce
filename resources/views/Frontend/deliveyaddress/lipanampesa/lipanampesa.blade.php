<?php Use App\Models\Product;?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')

<div class="span9" >
    <ul class="breadcrumb">
		<li><a href="{{ route('cart.show') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Checkout</li>
    </ul>
	<h3>  Checkout</h3>	
	<hr class="soft"/>
	
	@include('layouts.adminlayout.adminpartials.alertss')
			<div align="center" >
                <h3 class="text-center">Your Order Has been Placed Successfully</h3>
                <p>Your Order number is {{Session::get('order_id')}} and the amount to be paid is  grand total is Kshs:/={{Session::get('grandtotall')/108}} </p>
            </div>
            <div class="container">
               
              <div>
                <h4>Obain access Token</h4>
                <h6 id="accesstoken"></h6>
                <button class="btn btn-primary" id="getaccesstoken">Obtain access Token</button>     
              </div>
              <hr >
              <div>
                <h4>Register Urls</h4>
                <button class="btn btn-primary">Register Urls</button>     
              </div>
              <hr style="height: 2px;fond" >
              <div class="col-md-4">
                  <h4>Simulate transaction</h4>
                  <form action="" method="POST">
                      <div class="form-group{{$errors->has('amount')?' has-error':''}}">
                        @csrf
                          <label for="amount">Amount</label>
                          <input type="text" name="amount" value="" placeholder="amount">
                          @if ($errors->has('currentpassword'))
                          <span class="help-block text-danger">{{$errors->first('currentpassword')}}</span>
                      @endif
                        </div>
                      <div class="form-group">
                        <label for="amount">Account</label>
                        <input type="text" name="account" value="" placeholder="account">
                    </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Simulate payment</button>
                      </div>

                  </form>
              </div>

               
                
              </div>
            </div>
           <script src="{{asset('js/app.js')}}"></script>
            <script>
            document.getElementById('getaccesstoken').addEventListener('click',(event)=>{
              event.preventDefault()
              axios.post('/getaccesstoken',{})
                    .then((response)=>{
                      //console.log(response.data);
                      console.log(response);
                      document.getElementById('accesstoken').innerHTML=response.data.accesstoken
                    })
                    .catch((error)=>{
                      console.log(error);
                    })
                    
              
            })
            </script> 
            
           

@endsection
<?php
//  Session::forget('grandtotall');
//  Session::forget('order_id');
//  Session::forget('couponcode');
// Session::forget('couponamount');
?>