@extends('templates.default')
@section('content')

 <div class="row">
   <div class="col-md-2"></div>
  <div class="col-md-7" style="background-color: aliceblue">
     <div class="panel panel-default" style="box-shadow: 3px rgb(96, 100, 100) 3px green 3px blueviolet">
         <div class="panel-heading">
            <h3 class="text-center">Sign up</h3>
         </div>
                <form action="{{ route('auth.getsignup') }}" role="form" method="POST">
                    @csrf
                    <div class="panel-body">
                    <div class="form-group col-xs-9 col-md-6{{$errors->has('first_name')?' has-error':''}}">
                        <label for="first_name" class="control-label">Your first name</label>
                        <input type="text" name="first_name" value="{{Request::old('first_name')}}" placeholder="your first  name" class="form-control">
                        @if ($errors->has('first_name'))
                            <span class="help-block">{{$errors->first('first_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group col-xs-9 col-md-6{{$errors->has('last_name')?' has-error':''}}">
                        <label for="last_name" class="control-label">Your last name</label>
                        <input type="text" name="last_name" value="{{Request::old('last_name')}}" placeholder="your last_name" class="form-control">
                        @if ($errors->has('last_name'))
                            <span class="help-block">{{$errors->first('last_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group col-xs-9 col-md-6{{$errors->has('email')?' has-error':''}}">
                        <label for="email" class="control-label">Your email</label>
                        <input type="text" name="email" value="{{Request::old('email')}}" placeholder="your email" class="form-control">
                        @if ($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="form-group col-xs-9 col-md-6{{$errors->has('password')?' has-error':''}}">
                        <label for="password" class="control-label">Your password</label>
                        <input type="password" name="password"  placeholder="your password" class="form-control">
                        @if ($errors->has('password'))
                            <span class="help-block">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="form-group col-xs-9 col-md-6">
                        <label for="password_confirmation" class="control-label">Password again</label>
                        <input type="password" name="password_confirmation"  placeholder="password again" class="form-control">
                       
                    </div>
                </div>
                    <div class=" panel panel-footer" style="height: 50px">
                         <div class="form-group col-xs-9 col-md-6">
                        <button type="submit" class="btn btn-warning">Sign Up</button>
                    </div> 
                    </div>
                </form>
     </div>
  </div>
 </div>











  
@endsection