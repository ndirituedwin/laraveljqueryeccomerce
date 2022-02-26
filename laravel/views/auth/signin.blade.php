@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center">Sign in</h3>
                </div>
                
                <form action="{{ route('auth.getsignin')}}" role="form" method="POST" class="form-vertical">
                    @csrf
                    <div class="panel-body">
                        <div class="form-group col-xs-9 col-md-6{{$errors->has('email')?' has-error':''}}">
                            <label for="email" class="control-label"> email address</label>
                            <input type="text" name="email" value="{{Request::old('email')}}" placeholder="your email" class="form-control">
                            @if ($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                      
                        <div class="form-group col-xs-9 col-md-6{{$errors->has('password')?' has-error':''}}">
                            <label for="password" class="control-label">Your password</label>
                            <input type="password" class="form-control" name="password"  placeholder="your password">
                            @if ($errors->has('password'))
                                <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="checkbox col-xs-9 col-md-6">
                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="remember" >Remembe me
                    
                        </div>
                       
                    </div>  
               <div class="panel-footer" style="height: 100px">
                        <input type="submit" value="Sign in" class="btn btn-primary form-control">
                 
                        <a href="login/google" style="margin-top: 10px" class="btn btn-primary form-control">Sign in with Google+</a>

               </div>   
                </form>
                    </div>


            </div>
        </div>



        
@endsection