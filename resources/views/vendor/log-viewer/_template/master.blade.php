@extends('admin.layouts.base')
@section('title','日志面板')
@section('link')
    @include('log-viewer::_template.style')
@endsection
@section('script')
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/chartjs/Chart.min.js')}}"></script>
@endsection
@section('script_desc')
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    @yield('scripts')
@endsection