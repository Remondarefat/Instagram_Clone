<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instagram @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('includes.navbar')
    @yield('content')

    <script src="{{ asset('js/jQuery-Dev.js') }}"></script>
    <script src="{{ asset('js/jQuery-p.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
