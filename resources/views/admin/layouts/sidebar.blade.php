<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>首页面板</span>
                </a>
            </li>
            @foreach(Request::get('leftMenus') as $leftMenu)
                <li class="treeview @if(isset($leftMenu['active'])) active @endif">
                    <a href="#">
                        <i class="fa {{ $leftMenu['icon'] }}"></i>
                        <span>{{ $leftMenu['label'] }}</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($leftMenu['children'] as $child)
                            <li class="@if(isset($child['active'])) active @endif"><a href="{{ route($child['name']) }}"><i class="fa {{ $child['icon'] }}"></i>{{ $child['label'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>