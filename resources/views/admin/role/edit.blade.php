@extends('admin.layouts.base')

@section('title','编辑角色')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/role') }}">角色列表</a></li>
            <li class="active">编辑角色</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('admin.common.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">编辑角色</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" action="{{ url('admin/role'.'/'.$role['id']) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @include('admin.role._form')
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="submit" class="btn btn-primary" value="保存">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
