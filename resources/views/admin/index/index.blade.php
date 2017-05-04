@extends('admin.layouts.base')

@section('title','主页')

@section('content-header')
    <section class="content-header">
        {{--<h1>首页面板</h1>--}}
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="callout callout-info">
            <h4>Tip!</h4>
            <p>首页面板</p>
        </div>
    </section>
@endsection