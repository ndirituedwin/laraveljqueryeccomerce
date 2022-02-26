
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Delivery Address</li>
    </ul>
	<h3>Add Delivery address</h3>	
	@include('layouts.adminlayout.adminpartials.alertss')
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well">
			Enter your delivery address details.<br/><br/><br/>
			<form action="{{ route('delivery.add') }}" method="POST" id="deliveryaddressform">
				@csrf
                <div class="control-group{{$errors->has('name')?' has-error  text-danger':''}}">
                    <label for="name" class="control-label" > Name</label>
                    <div class="controls">
                      <input class="span3"  type="text" value="{{Request::old('name')?:Auth::user()->name}}" id="name" name="name" placeholder="first name">
					  
                    </div>@if ($errors->has('name'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('name')}}</font></span>
				  @endif
                  </div>
			
                
                  <div class="control-group{{$errors->has('address')?' has-error  text-danger':''}}">
                    <label class="control-label" for="address">Address</label>
                    <div class="controls">
                   <textarea name="address" id="address" class="span3"   rows="3" >{{Request::old('address')?:Auth::user()->address}}</textarea>
                        @if ($errors->has('address'))
					  <span class="help-block text-danger"><font color="red">{{$errors->first('address')}}</font></span>
				  @endif
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
                         <option value="{{$country['country_name']}}" @if ($country['country_name']==old('country'))  selected
                             
                         @endif>{{Request::old('country_name')?:$country['country_name']}}</option>
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
              <div>
                <button type="submit" class="btn btn-success">Enter</button>
               <a href="{{ route('checkout.page') }}" class="btn btn-warning">Go back</a>
            </div>
			</form>
		</div>
		</div>
	
	</div>	
	
</div>
@endsection