<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($meta)){{ $meta['title'] }}@else {{ env('APP_NAME') }} @endif</title>
    <meta name="description" content="@if(isset($meta)){{ $meta['description'] }}@endif">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @section('css')
        <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/layui.css')}}" media="all">
        <link rel="stylesheet" href="{{asset('layuiadmin/style/admin.css')}}" media="all">
        <link rel="stylesheet" href="{{asset('layuiadmin/style/login.css')}}" media="all">
    @show
    {{--自定义css--}}
    @section('css_ext')
    @show

</head>
<body>
    @yield('content')
</body>
{{--scripts--}}
@section('js')
    <script src="{{asset('layuiadmin/layui/layui.js')}}"></script>
@show

{{--自定义js--}}
@section('js_ext')
@show
</html>
