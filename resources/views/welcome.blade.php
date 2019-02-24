<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{!! asset('public/css/app.css') !!}">
    </head>
    <body>
        <div id="app">
            <example-component></example-component>
        </div>
        <script src="{!! asset('public/js/app.js') !!}"></script>
    </body>
</html>