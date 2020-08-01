<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Kosugi&display=swap" rel="stylesheet">
    @yield('head')
    <style>
        body {
            font-family: 'Kosugi', sans-serif;
        }
    </style>
    <title>OME Portal - @yield('title')</title>
</head>
<body>
    <div id="app" class="container">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
