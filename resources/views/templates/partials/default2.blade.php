<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ndiritu</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('js/vendor/bootstrap.min.js')}}">
        <link rel="stylesheet" href="{{asset('js/vendor/jquery-1.11.2.min.js')}}">
    </head>
    <body style="background-color: rgb(238, 222, 222)">
        <div class="container">
            @include('templates.partials.alerts')
            @yield('content')
        </div>
    </body>
</html>