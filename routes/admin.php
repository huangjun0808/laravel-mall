<?php

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::match(['get', 'post'], 'logout', 'LoginController@logout');

Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('/', 'IndexController@index');

    //用户管理路由
    Route::match(['get', 'post'], 'user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::resource('user', 'UserController', ['names' => [
        'index' => 'admin.user.index',
        'create' => 'admin.user.create',
        'store' => 'admin.user.store',
        'show' => 'admin.user.show',
        'edit' => 'admin.user.edit',
        'update' => 'admin.user.update',
        'destroy' => 'admin.user.destroy',
    ]]);
    //权限管理路由
    Route::match(['get', 'post'], 'permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::get('permission/{cid?}', ['uses' => 'PermissionController@index'])->where('cid', '[0-9]+');
    Route::get('permission/{cid}/create', ['uses' => 'PermissionController@create'])->where('cid', '[0-9]+');
    Route::get('permission/{id}/edit', ['as'=>'admin.permission.edit','uses' => 'PermissionController@edit'])->where('id', '[0-9]+');
    Route::resource('permission', 'PermissionController', [
        'except' => ['show','edit'],
        'names' => [
            'index' => 'admin.permission.index',
            'create' => 'admin.permission.create',
            'store' => 'admin.permission.store',
            'update' => 'admin.permission.update',
            'destroy' => 'admin.permission.destroy',
        ],
    ]);
    //角色管理路由
    Route::match(['get', 'post'], 'role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::get('role/{id}/edit', ['as'=>'admin.role.edit','uses' => 'RoleController@edit'])->where('id', '[0-9]+');
    Route::resource('role', 'RoleController', [
        'except' => ['show','edit'],
        'names' => [
            'index' => 'admin.role.index',
            'create' => 'admin.role.create',
            'store' => 'admin.role.store',
            'update' => 'admin.role.update',
            'destroy' => 'admin.role.destroy',
        ],
    ]);
});