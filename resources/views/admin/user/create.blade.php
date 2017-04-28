@extends('admin.layouts.base')

@section('title','添加用户')

@section('content-header')
    <section class="content-header">

    </section>
@endsection

@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">添加用户</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ url('admin/user') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">用户名</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="name" placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">邮箱</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="email" placeholder="请输入邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">密码</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="password" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-3 control-label">密码确认</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="confirm_password" placeholder="请再次输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles" class="col-sm-3 control-label">角色列表</label>
                        <div class="col-sm-5">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <input type="submit" class="btn btn-primary" value="添加">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
