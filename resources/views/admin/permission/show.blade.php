@extends('admin.layouts.base')

@section('title','权限详情')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/permission') }}">权限列表</a></li>
            <li class="active">权限详情</li>
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
                        <h3 class="box-title">权限详情</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">权限规则</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $permission['name'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="label" class="col-sm-3 control-label">权限名称</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $permission['label'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">是否菜单</label>
                                <div class="col-sm-6">
                                    @if($permission['type']==0)
                                        <label class="radio-inline">
                                            <input type="radio" name="permission[type]" value="0" checked>权限(默认)
                                        </label>
                                    @elseif($permission['type']==1)
                                        <label class="radio-inline">
                                            <input type="radio" name="permission[type]" value="1" checked>左侧菜单
                                        </label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-3 control-label">图标</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static"><i class="fa {{ $permission['icon'] }}"></i></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">权限概述</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $permission['description'] }}</p>
                                </div>
                            </div>
                            @if(!$permission->children->isEmpty())
                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label">下级菜单</label>
                                    <div class="col-sm-6">
                                        <div class="form-control-static">
                                            <ul class="list-group spe-list-group">
                                                @foreach($permission['children'] as $child)
                                                    <li class="list-inline">
                                                        <a href="{{ url('admin/permission') . '/' . $child['id'] }}">{{ $child['label'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">创建时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $permission['created_at'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">修改时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $permission['updated_at'] }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
