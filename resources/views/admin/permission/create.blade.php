@extends('admin.layouts.base')

@section('title','添加权限')

@section('link')
    <link href="{{asset('static/libs/bootstrap-iconpicker/1.7.0/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{asset('static/libs/bootstrap-iconpicker/1.7.0/bootstrap-iconpicker/js/iconset/iconset-glyphicon.min.js')}}"></script>
    <script src="{{asset('static/libs/bootstrap-iconpicker/1.7.0/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js')}}"></script>
    <script src="{{asset('static/libs/bootstrap-iconpicker/1.7.0/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>
@endsection

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/permission') }}">权限列表</a></li>
            <li class="active">添加权限</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 row-button-group">
                @include('admin.common.form_message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加权限</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" action="{{ url('admin/permission') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="permission[cid]" value="{{ $cid }}">
                            @include('admin.permission._form')
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="submit" class="btn btn-primary" value="添加">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
