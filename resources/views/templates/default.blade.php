<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ndiritu</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body>
     @include('templates.partials.navigation')
        <div class="container">
            @include('templates.partials.alerts')
            @yield('content')
        </div>
    </body>
</html>