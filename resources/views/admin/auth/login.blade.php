<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{asset('static/libs/bootstrap/3.3.5/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('static/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('static/libs/ionicons/2.0.1/css/ionicons.min.css')}}" rel="stylesheet">

    <link href="{{asset('static/libs/AdminLTE/2.3.11/dist/css/AdminLTE.min.css')}}" rel="stylesheet">

    <link href="{{asset('static/libs/AdminLTE/2.3.11/plugins/iCheck/minimal/blue.css')}}" rel="stylesheet">

</head>
<body class="hold-transition login-page" style="height: auto;">
    <div class="login-box">
        <div class="login-logo">
            <b>Admin</b>LTE
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">后台登录</p>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="邮箱">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck" style="margin: 6px 0 5px 0;">
                            <label>
                                <input type="checkbox"> &nbsp;&nbsp;记住我
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{asset('static/libs/jquery/2.1.4/jquery.min.js')}}"></script>
    <script src="{{asset('static/libs/bootstrap/3.3.5/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('static/libs/AdminLTE/2.3.11/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
</html>