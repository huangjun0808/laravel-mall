<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>首页面板</span>
                </a>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>权限管理</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/user') }}"><i class="fa fa-circle-o"></i>用户列表</a></li>
                    <li><a href="boxed.html"><i class="fa fa-circle-o"></i>角色列表</a></li>
                    <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i>权限列表</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>