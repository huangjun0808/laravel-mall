<?php

Route::get('login','LoginController@showLoginForm')->name('admin.login');
Route::post('login','LoginController@login');
Route::match(['get','post'],'logout','LoginController@logout');

Route::group(['middleware'=>['auth:admin']], function(){

    Route::get('/', 'IndexController@index');

});