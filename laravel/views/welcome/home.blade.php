@extends('templates.default')
@section('content')
    @auth
      Welcome home
        @else
        You are not authenticated
    @endauth
@endsection