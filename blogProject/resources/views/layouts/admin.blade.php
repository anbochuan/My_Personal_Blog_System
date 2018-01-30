<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/fonts/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
</head>
<body>
@yield('content')
</body>
</html>