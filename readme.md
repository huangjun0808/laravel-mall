# Laravel 5.3 后台管理系统实例

###主要模块

>RBAC权限管理: 基于laravel 5.3 与 自带的gate来做权限认证,左侧菜单栏是基于权限来生成

## 截图

![](http://opepgx14e.bkt.clouddn.com/permission.png)

## 安装

- git clone 到本地
- 执行 `composer install`,创建好数据库
- 配置 **.env** 中数据库连接信息,没有.env请复制.env.example命名为.env
- 执行 `php artisan key:generate`
- 执行 `php artisan migrate`
- 执行 `php artisan db:seed`
- 键入 '域名/admin/login'(后台登录)
- 默认后台账号:root@admin.com 密码:root123