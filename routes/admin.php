<?php

Route::get('login',[
    'as'=>'admin.login','uses'=>'LoginController@showLoginForm'
]);

Route::group(['middleware'=>['auth:admin']], function(){

    Route::get('/', 'IndexController@index');

});