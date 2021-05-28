@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-xs-9 col-md-6 ">
            <form action="{{ route('profile.edit')}}" role="form" method="POST" class="form-vertical">
            @csrf
                <div class="form-group col-xs-9 col-md-6{{$errors->has('first_name')?' has-error':''}}">
                <label for="first_name" class="control-label">First name</label>
                <input type="text" name="first_name" value="{{Request::old('first_name')?:Auth::user()->first_name}}" placeholder="your first_name" class="form-control">
                @if ($errors->has('first_name'))
                    <span class="help-block">{{$errors->first('first_name')}}</span>
                @endif
            </div>
            <div class="form-group col-xs-9 col-md-6{{$errors->has('last_name')?' has-error':''}}">
                <label for="last_name" class="control-label">Your last name</label>
                <input type="text" name="last_name" value="{{Request::old('last_name')?:Auth::user()->last_name}}" class="form-control" placeholder="your last_name">
                @if ($errors->has('last_name'))
                    <span class="help-block">{{$errors->first('last_name')}}</span>
                @endif
            </div>           
            <div class="form-group col-xs-9 col-md-6">
                <input type="submit" value="Update Profile" class="btn btn-success">
            </div>
            </form>
        </div>
    </div>
@endsection