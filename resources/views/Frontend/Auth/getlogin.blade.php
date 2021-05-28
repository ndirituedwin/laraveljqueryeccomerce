
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login/Sign up</h3>	
	@include('layouts.adminlayout.adminpartials.alertss')
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			Enter your name plus e-mail address to create an account.<br/><br/><br/>
			<form action="{{ route('auth.registeruser') }}" method="POST" id="registerclient">
				@csrf
                <div class="control-group{{$errors->has('first_name')?' has-error  text-danger':''}}">
                    <label for="first_name" class="control-label" >First Name</label>
                    <div class="controls">
                      <input class="span3"  type="text" value="{{Request::old('first_name')}}" id="first_name" name="first_name" placeholder="first name">
					  
                    </div>@if ($errors->has('first_name'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('first_name')}}</font></span>
				  @endif
                  </div>
				  <div class="control-group{{$errors->has('last_name')?' has-error ':''}}">
                    <label class="control-label" for="last_name">Last Name</label>
                    <div class="controls">
                      <input class="span3" id="last_name" value="{{Request::old('last_name')}}" name="last_name"  type="text"  placeholder="last name">
					  @if ($errors->has('last_name'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('last_name')}}</font></span>
				  @endif
					</div>
					
                  </div>
				  <div class="control-group">
                    <label class="control-label" for="mobile">Mobile</label>
                    <div class="controls">
                      <input class="span3" id="mobilenumber" value="{{Request::old('mobile')}}" name="mobile"  type="text"  placeholder="mobile">
					  @if ($errors->has('mobile'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('mobile')}}</font></span>
				  @endif
				  <br><span id="checkphonenumber"></span>

					</div>
                  </div>
			  <div class="control-group">
				<label class="control-label" for="email">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="text" value="{{Request::old('email')}}" id="emailvalidate" name="email" placeholder="Email">
				  @if ($errors->has('email'))
				  <span class="help-block text-danger"><font color="red">{{$errors->first('email')}}</font></span>
			  @endif <br>
			  <span id="checkcurrentemail"></span>
				</div>
			  </div>
              <div class="control-group">
				<label class="control-label" for="password">Choose a password</label>
				<div class="controls">
				  <input class="span3"  name="password"  type="password" id="password" placeholder=" choose password">
				  @if ($errors->has('password'))
				  <span class="help-block text-danger"><font color="red">{{$errors->first('password')}}</font></span>
			  @endif
			  <span id="checkcurrentpassword"></span>
				</div>
			  </div>
			  <div class="control-group">
				<label for="password_confirmation" class="control-label">Password again</label>
				<input type="password" name="password_confirmation" id="password_confirmation"  placeholder="password again" class="form-control">
				<br>
				<span id="checkconfirmpassword"></span>
			</div>

			  <div class="controls">
			  <button type="submit" class="btn block">Create Your Account</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ALREADY REGISTERED ?</h5>
			<a href="{{ route('client.getlogin') }}">Login</a>
			
		</div>
		</div>
	</div>	
	
</div>
@endsection