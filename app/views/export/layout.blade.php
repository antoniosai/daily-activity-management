<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro-icons.css') }}">


    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }
    </style>
    @yield('style')
</head>
<body>
@yield('content')
</body>
</html>