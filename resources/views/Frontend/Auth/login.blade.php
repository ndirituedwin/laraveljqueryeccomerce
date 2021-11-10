
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
	
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ALREADY REGISTERED ?</h5>
			<form method="POST" action="{{ route('client.getlogin') }}">
                @csrf
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Email</label>
				<div class="controls">
				  <input class="span3" name="email"  type="text" id="emailone" placeholder="Email">
                  @if ($errors->has('email'))
                  <span class="help-block "><font color="red">{{$errors->first('email')}}</font></span>
              @endif <br>
			  
			  <span id="checkcurrentemail"></span>
                </div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
				  <input type="password" class="span3" name="password"  id="passwordone" placeholder="Password">
                  @if ($errors->has('password'))
                  <span class="help-block">{{$errors->first('password')}}</span>
              @endif <br>
			  <span id="checkcurrentpassword"></span>
                </div>
			  </div>
              <div class="checkbox ">
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="remember" >Remember me
        
            </div><br>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Sign in</button> <a href="{{ route('password.forgot') }}">Forgot password?</a>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>
@endsection