@extends('admin.layouts.base')

@section('title','用户详情')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/user') }}">用户列表</a></li>
            <li class="active">用户详情</li>
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
                        <h3 class="box-title">用户详情</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">用户名</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $user['name'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">邮箱</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $user['email'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roles" class="col-sm-3 control-label">拥有角色</label>
                                <div class="col-sm-7">
                                    <div class="form-control-static">
                                        @if(!$user->roles->isEmpty())
                                            <ul class="list-group spe-list-group">
                                                @foreach($user['roles'] as $child)
                                                    <li class="list-inline">
                                                        <a href="{{ url('admin/role') . '/' . $child['id'] }}">{{ $child['name'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($user->id==1)
                                            超级管理员
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">创建时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $user['created_at'] }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">修改时间</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">{{ $user['updated_at'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
