<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            {{--<li class="header">MAIN NAVIGATION</li>--}}
            <li class="treeview">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>首页面板</span>
                </a>
            </li>
            @foreach(Request::get('leftMenus') as $leftMenu)
                <li class="treeview @if(isset($leftMenu['active'])) active @endif">
                    <a href="{{ isset($leftMenu['children']) ? '#' : url($leftMenu['uri'])}}">
                        <i class="fa {{ $leftMenu['icon'] }}"></i>
                        <span>{{ $leftMenu['label'] }}</span>
                        @if(isset($leftMenu['children']))
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        @endif
                    </a>
                    @if(isset($leftMenu['children']))
                    <ul class="treeview-menu">
                        @foreach($leftMenu['children'] as $child)
                            <li class="@if(isset($child['active'])) active @endif"><a href="{{ url($child['uri']) }}"><i class="fa {{ $child['icon'] }}"></i>{{ $child['label'] }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>