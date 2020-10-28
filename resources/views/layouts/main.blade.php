<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"> {{--        is queried by javascript functions in script.js--}}
        <title>Titel</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}"/>
        <script src="/js/app.js"></script>
    </head>
    <body>
        @yield('content')
    </body>
</html>
