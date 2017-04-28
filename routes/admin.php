<?php

Route::get('login','LoginController@showLoginForm')->name('admin.login');
Route::post('login','LoginController@login');
Route::match(['get','post'],'logout','LoginController@logout');

Route::group(['middleware'=>['auth:admin']], function(){

    Route::get('/', 'IndexController@index');

    //用户管理路由
    Route::match(['get','post'],'user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::resource('user','UserController', ['names'=>[
        'index'=>'admin.user.index',
        'create'=>'admin.user.create',
        'store'=>'admin.user.store',
        'show'=>'admin.user.show',
        'edit'=>'admin.user.edit',
        'update'=>'admin.user.update',
        'destroy'=>'admin.user.destroy',
    ]]);


});