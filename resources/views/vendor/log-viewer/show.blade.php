@extends('log-viewer::_template.master')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{ url('admin/log-viewer/logs') }}">日志列表</a></li>
            <li class="active">日志详情</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row row-button-group">
            <div class="col-xs-6 col-sm-6">
                <h4>日志详情 [{{ $log->date }}]</h4>
            </div>
            <div class="col-xs-6 col-sm-6 text-right">

            </div>
        </div>

    <div class="row">
        <div class="col-md-2">
            @include('log-viewer::_partials.menu')
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    日志信息 :

                    <div class="group-btns pull-right">
                        <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-xs btn-success">
                            <i class="fa fa-download"></i> 下载
                        </a>
                        <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-toggle="modal">
                            <i class="fa fa-trash-o"></i> 删除
                        </a>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-condensed" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <td>文件路径 :</td>
                                    <td colspan="7">{{ $log->getPath() }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>数目 : </td>
                                    <td>
                                        <span class="label label-primary">{{ $entries->total() }}</span>
                                    </td>
                                    <td>大小 :</td>
                                    <td>
                                        <span class="label label-primary">{{ $log->size() }}</span>
                                    </td>
                                    <td>创建时间 :</td>
                                    <td>
                                        <span class="label label-primary">{{ $log->createdAt() }}</span>
                                    </td>
                                    <td>修改时间 :</td>
                                    <td>
                                        <span class="label label-primary">{{ $log->updatedAt() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                @if ($entries->hasPages())
                    <div class="panel-heading">
                        {!! $entries->render() !!}

                        <span class="label label-info pull-right">
                            Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                        </span>
                    </div>
                @endif
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="entries" class="table table-condensed table-status table-responsive" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th style="min-width: 50px;">环境</th>
                                    <th style="min-width: 65px;">级别</th>
                                    <th style="min-width: 75px;">时间</th>
                                    <th>头部信息</th>
                                    <th style="min-width: 70px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $key => $entry)
                                    <tr>
                                        <td>
                                            <span class="label label-env">{{ $entry->env }}</span>
                                        </td>
                                        <td>
                                            <span class="level level-{{ $entry->level }}">
                                                {!! $entry->level() !!}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="label label-default">
                                                {{ $entry->datetime->format('H:i:s') }}
                                            </span>
                                        </td>
                                        <td role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                            <p>{{ $entry->header }}</p>
                                        </td>
                                        <td>
                                            @if ($entry->hasStack())
                                                <a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                    <i class="fa fa-toggle-on"></i> Stack
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($entry->hasStack())
                                        <tr>
                                            <td colspan="5" class="stack">
                                                <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                                    {!! $entry->stack() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($entries->hasPages())
                    <div class="panel-footer">
                        {!! $entries->render() !!}

                        <span class="label label-info pull-right">
                            Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
        </section>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">删除文件</h4>
                    </div>
                    <div class="modal-body">
                        <p>确定要 <span class="label label-danger">删除</span> 这个文件 <span class="label label-primary">{{ $log->date }}</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
