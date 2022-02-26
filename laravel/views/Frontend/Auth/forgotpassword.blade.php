
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3>Forgot Password</h3>	
	@include('layouts.adminlayout.adminpartials.alertss')
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>Forgot password</h5><br/>
			Enter your email to get the new password<br/><br/><br/>
			<form action="{{ route('password.forgot') }}" method="POST" id="forgotpassword">
				@csrf
                <div class="control-group{{$errors->has('email')?' has-error  text-danger':''}}">
                    <label for="email" class="control-label" >Email</label>
                    <div class="controls">
                      <input class="span3"  type="text" value="{{Request::old('email')}}" id="email" name="email" placeholder="first name">
					  
                    </div>@if ($errors->has('email'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('email')}}</font></span>
				  @endif
                  </div>
                  <div>
                      <button class="btn btn-success">Generate password</button>
                  </div>
				 
		
	</div>	
	
</div>
@endsection