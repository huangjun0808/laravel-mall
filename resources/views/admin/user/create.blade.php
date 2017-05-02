@extends('admin.layouts.base')

@section('title','添加用户')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/user') }}">用户列表</a></li>
            <li class="active">添加用户</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('admin.common.form_message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加用户</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" action="{{ url('admin/user') }}" method="post">
                            {{ csrf_field() }}
                            @include('admin.user._form')
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
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
