<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            {{$data->name}}
        </title>
    </head>
    <body>
        @php
            include($data->file);
        @endphp
    </body>
</html>
