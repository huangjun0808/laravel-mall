@extends('admin.layouts.base')

@section('title','主页')
@section('link')
    @include('log-viewer::_template.style')
@endsection
@section('script')
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/chartjs/Chart.min.js')}}"></script>
@endsection
@section('script_desc')
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
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

@section('content-header')
    <section class="content-header">
        {{--<h1>首页面板</h1>--}}
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="callout callout-info">
            <h4>Tip!</h4>
            <p>首页面板</p>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">日志面板</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
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
                                        <a href="{{ $item['count'] === 0 ? 'javascript:;' : route('log-viewer::logs.list') }}" class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                            <span class="info-box-icon">
                                                {!! log_styler()->icon($level) !!}
                                            </span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $item['name'] }}</span>
                                                <span class="info-box-number" style="font-size:16px;">
                                                    {{ $item['count'] }} 条 - {!! $item['percent'] !!} %
                                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection