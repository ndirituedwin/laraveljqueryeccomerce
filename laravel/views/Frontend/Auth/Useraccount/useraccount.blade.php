
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
			<h5>My ACCOUNT</h5><br/>
			Enter your namecontact details.<br/><br/><br/>
			<form action="{{ route('user.account') }}" method="POST" id="accountformvalidation">
				@csrf
                <div class="control-group{{$errors->has('first_name')?' has-error  text-danger':''}}">
                    <label for="first_name" class="control-label" >First Name</label>
                    <div class="controls">
                      <input class="span3"  type="text" value="{{Request::old('first_name')?:Auth::user()->first_name}}" id="first_name" name="first_name" placeholder="first name">

                    </div>@if ($errors->has('first_name'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('first_name')}}</font></span>
				  @endif
                  </div>
				  <div class="control-group{{$errors->has('last_name')?' has-error ':''}}">
                    <label class="control-label" for="last_name">Last Name</label>
                    <div class="controls">
                      <input class="span3" id="last_name" value="{{Request::old('last_name')?:Auth::user()->last_name}}" name="last_name"  type="text"  placeholder="last name">
					  @if ($errors->has('last_name'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('last_name')}}</font></span>
				  @endif
					</div>

                  </div>
                  <div class="control-group{{$errors->has('email')?' has-error  text-danger':''}}">
                    <label class="control-label" for="email">email</label>
                    <div class="controls">
                   <input type="text"class="span3"  id="email"  name="email" value="{{Request::old('email')?:Auth::user()->email}}"  class="form-control"></textarea>
                        @if ($errors->has('email'))
					  <span readonly class="help-block text-danger"><font color="red">{{$errors->first('email')}}</font></span>
				  @endif
					</div>
                  </div>
                  <div class="control-group{{$errors->has('mobile')?' has-error  text-danger':''}}">
                    <label class="control-label" for="mobile">mobile</label>
                    <div class="controls">
                   <input type="text" class="span3"  name="mobile" id="mobile" value="{{Request::old('mobile')?:Auth::user()->mobile}}"   class="form-control"/>
                        @if ($errors->has('mobile'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('mobile')}}</font></span>
				  @endif
				  <br>

					</div>
                  </div>
                  <div class="control-group{{$errors->has('address')?' has-error  text-danger':''}}">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls">
                   <textarea name="address" id="address" class="span3"   rows="3" >{{Request::old('address')?:Auth::user()->address}}</textarea>
                        @if ($errors->has('address'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('address')}}</font></span>
				  @endif
				  <br><span id="checkphonenumber"></span>

					</div>
                  </div>
                  <div class="control-group{{$errors->has('city')?' has-error  text-danger':''}}">
                    <label class="control-label" for="city">City</label>
                    <div class="controls">
                      <input type="text" name="city" class="span3" id="city" placeholder="city" value="{{Request::old('city')?:Auth::user()->city}}">
                        @if ($errors->has('city'))
                      <span class="help-block text-danger"><font color="red">{{$errors->first('city')}}</font></span>
                  @endif <br>

                    </div>
                  </div>
                  <div class="control-group{{$errors->has('state')?' has-error  text-danger':''}}">
                    <label class="control-label" for="state">state</label>
                    <div class="controls">
                      <input type="text" name="state" class="span3" id="state" placeholder="state" value="{{Request::old('state')?:Auth::user()->state}}">
                        @if ($errors->has('state'))
                      <span class="help-block text-danger"><font color="red">{{$errors->first('state')}}</font></span>
                  @endif <br>

                    </div>
                  </div>


			  <div class="control-group{{$errors->has('coutry')?' has-error  text-danger':''}}">
				<label class="control-label" for="country">country</label>
				<div class="controls">
                    <select name="country" id="country" class="span3">
                        <option value="0">Select</option>
                         @foreach ($countries as $country)
                         <option value="{{$country['id']}}" @if (isset(Auth::user()->country_id)&&Auth::user()->country_id==$country['id'])

                            selected
                         @endif>{{$country['country_name']}}</option>
                         @endforeach
                    </select>
                    @if ($errors->has('country'))
				  <span class="help-block text-danger"><font color="red">{{$errors->first('country')}}</font></span>
			  @endif <br>

				</div>
			  </div>

			  <div class="control-group{{$errors->has('pincode')?' has-error  text-danger':''}}">
				<label class="control-label" for="pincode">pincode</label>
				<div class="controls">
                  <input type="text" class="span3" name="pincode" id="pincode" placeholder="pincode" value="{{Request::old('pincode')?:Auth::user()->pincode}}">
                    @if ($errors->has('pincode'))
				  <span class="help-block text-danger"><font color="red">{{$errors->first('pincode')}}</font></span>
			  @endif <br>

				</div>
			  </div>
              <div>
                  <button type="submit" class="btn btn-success">Update</button>
              </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>Update Password</h5>
			<form action="{{ route('user.updatepassword') }}" method="POST" id="updatepasswordform">
                @csrf
                <div class="control-group">
                    <label class="control-label" for="currentpassword">currentpassword</label>
                    <div class="controls">
                      <input type="password" name="currentpassword" class="span3" id="currentpassword" placeholder="currentpassword">
                        @if ($errors->has('currentpassword'))
                      <span class="help-block text-danger"><font color="red">{{$errors->first('currentpassword')}}</font></span>
                  @endif <br>
                  <span id="currentpass"></span>

                  </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="newpassword">newpassword</label>
                    <div class="controls">
                      <input type="password" name="newpassword" class="span3" id="newpassword" placeholder="newpassword">
                        @if ($errors->has('newpassword'))
                      <span class="help-block text-danger"><font color="red">{{$errors->first('newpassword')}}</font></span>
                  @endif <br>

                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="confirmpassword">confirmpassword</label>
                    <div class="controls">
                      <input type="password" class="span3" name="confirmpassword" id="confirmpassword" placeholder="confirmpassword">
                        @if ($errors->has('confirmpassword'))
                      <span class="help-block text-danger"><font color="red">{{$errors->first('confirmpassword')}}</font></span>
                  @endif <br>
                  <span id="confirmpass"></span>

                    </div>
                    <div class="">
                        <button class="btn btn-default">Update password</button>
                    </div>
                  </div>
            </form>
		</div>
		</div>
	</div>

</div>
@endsection
