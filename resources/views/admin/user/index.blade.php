@extends('admin.layouts.base')

@section('title','用户列表')

@section('link')
    <link href="{{asset('static/libs/AdminLTE/2.3.11/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
@endsection

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="javascript:">权限管理</a></li>
            <li class="active">用户列表</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row row-button-group">
            <div class="col-xs-6 col-sm-6">
            </div>
            <div class="col-xs-6 col-sm-6 text-right">
                @if(Gate::forUser(auth('admin')->user())->check('admin.user.create'))
                    <a href="{{ url('admin/user/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 添加用户</a>
                @endif
            </div>
        </div>
        <div class="message">
            @include('admin.common.message')
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">用户列表</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="user_list" class="table table-hover table-bordered" cellspacing="0" width="100%">
                    <!--表格数据-->
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        @include('admin.common.delete_modal')
    </section>
@endsection

@section('script_desc')
    <script>
        // 默认设置
        $.extend( $.fn.dataTable.defaults, {
            searching: true,
            ordering:  true,
        } );

        $(document).ready(function() {
            var table = $('#user_list').DataTable({
                language: {
                    "url":"{{ asset('static/dataTable_zh_CN.json') }}",
                },
                "dom": '<"row row-office-top"<"col-sm-6"i><"col-sm-6"<"#search">>><"row"<"col-sm-12"rt>><"row row-top"<"col-sm-6"l><"col-sm-6"p>>',
                "autoWidth": true,
                "order": [[0, "asc"]],
                "lengthMenu": [ 50, 100, 150, 200 ],
                "serverSide": true,
                "ajax": {
                    "url": '{{ url('admin/user/index') }}',
                    "type": 'post',
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                "columns": [
                    {"data": "id", "title": "ID"},
                    {"data": "name", "title": "用户名"},
                    {"data": "email", "title": "邮箱"},
                    {"data": "created_at", "title": "创建日期"},
                    {"data": "updated_at", "title": "修改日期"},
                    {"data": "action", "title": "操作", "orderable":false, "searchable": false}
                ],
                "columnDefs": [
                    {
                        "targets": -1,
                        "render": function (data, type, row, meta) {
                            var userVerify = '{{ auth('admin')->user()->id == 1 }}';
                            var str = '';
                            //编辑
                            @if(Gate::forUser(auth('admin')->user())->check('admin.user.edit'))
                                if(row['id'] != 1 || userVerify){
                                    str += '<a href="{{ url('admin/user') }}' + '/' + row['id'] + '/edit" class="text-success btn-xs"><i class="fa fa-edit"></i> 编辑</a>';
                                }
                            @endif
                            @if(Gate::forUser(auth('admin')->user())->check('admin.user.show'))
                                str += '<a href="{{ url('admin/user') }}' + '/' + row['id'] + '" class="text-success btn-xs"><i class="fa fa-file-text-o"></i> 详情</a>';
                            @endif

                            //删除
                            @if(Gate::forUser(auth('admin')->user())->check('admin.user.destory'))
                                if(row['id'] != 1 || userVerify){
                                    str += '<a href="javascript:;" data-attr="'+row['id']+'" class="text-danger btn-xs delBtn"><i class="fa fa-times-circle"></i> 删除</a>';
                                }
                            @endif
                            return str;
                        }
                    }
                ]
            });

            //ajax事件-当datatable发出ajax请求前
            table.on('preXhr.dt', function (e, settings, data) {
                loadShow();
            });

            //重绘事件-当表格重绘完成后
            table.on('draw.dt', function () {
                loadFadeOut();
                $("#search").html('<div class="form-horizontal"><div class="row"> <div class="col-sm-12 text-right"> <div class="input-group"> <label class="sr-only">搜索</label> <input type="text" class="form-control input-sm" name="search" placeholder="请输入用户名或邮箱"> <span class="input-group-btn"> <button class="btn btn-default btn-sm" type="button" id="searchBtn"><i class="fa fa-search"></i> 搜索</button> </span> </div> </div> </div> </div>');

            });
            
            $(document).on('click', '#searchBtn', function () {
                var _value = $.trim($("input[name='search']").val());
                table.search(_value).draw();
            });
            
            $(document).keydown(function () {
                if(event.keyCode === 13){
                    $("#searchBtn").click();
                }
            });

            $(document).on('click', '.delBtn', function () {
                var _id = $(this).data('attr');
                $('.modal-delete .tips').html('确认要删除这个用户吗?');
                $('.deleteForm').attr('action','{{ url('admin/user') }}' + '/' + _id);
                $('.modal-delete').modal();
            })
        });
    </script>
@endsection