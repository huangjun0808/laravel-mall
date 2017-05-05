@extends('log-viewer::_template.master')

@section('content-header')
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="javascript:">日志管理</a></li>
            <li class="active">日志面板</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row row-button-group">
            <div class="col-xs-6 col-sm-6">
                <h4>日志面板</h4>
            </div>
            <div class="col-xs-6 col-sm-6 text-right">

            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div style="max-width: 260px;margin: 0 auto;">
                    <canvas id="stats-doughnut-chart" height="300"></canvas>
                </div>
            </div>
            <div class="col-md-9">
                <section class="box-body">
                    <div class="row">
                        @foreach($percents as $level => $item)
                            <div class="col-md-4">
                                <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                    <span class="info-box-icon">
                                        {!! log_styler()->icon($level) !!}
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $item['name'] }}</span>
                                        <span class="info-box-number">
                                            {{ $item['count'] }} 条 - {!! $item['percent'] !!} %
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            new Chart($('canvas#stats-doughnut-chart'), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    },

                }
            });
        });
    </script>
@endsection