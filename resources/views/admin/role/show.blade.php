@extends('admin.layouts.base')

@section('title','角色详情')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/role') }}">角色列表</a></li>
            <li class="active">角色详情</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row row-button-group">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">角色详情</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">角色名称</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $role['name'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">角色概述</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $role['description'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">拥有权限</label>
                                <div class="col-sm-7">
                                    <div class="form-control-static">
                                        @if(!$role->permissions->isEmpty())
                                            <ul class="list-group spe-list-group">
                                                @foreach($role['permissions'] as $child)
                                                    <li class="list-inline">
                                                        <a href="{{ url('admin/permission') . '/' . $child['id'] }}">{{ $child['label'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">创建时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $role['created_at'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">修改时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $role['updated_at'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
