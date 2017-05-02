<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理平台 | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('static/libs/bootstrap/3.3.5/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/libs/ionicons/2.0.1/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/libs/AdminLTE/2.3.11/dist/css/AdminLTE.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/libs/AdminLTE/2.3.11/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/libs/loaders/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('static/css/admin.css')}}" rel="stylesheet">
    @section('link')
    @show
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- 顶部区 -->
        @include('admin.layouts.header')
        <!-- 左侧菜单区 -->
        @include('admin.layouts.sidebar')
        <!-- 内容区 -->
        <div class="content-wrapper">
            @include('admin.layouts.loading')
            <!-- Content Header (Page header) -->
            @yield('content-header')
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- 底部区 -->
        @include('admin.layouts.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{asset('static/libs/jquery/2.1.4/jquery.min.js')}}"></script>
    <script src="{{asset('static/libs/bootstrap/3.3.5/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('static/libs/AdminLTE/2.3.11/dist/js/app.min.js')}}"></script>
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/fastclick/fastclick.js')}}"></script>
    <script src="{{asset('static/js/admin.js')}}"></script>
    @yield('script')
    @yield('script_desc')
</body>
</html>