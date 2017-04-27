<?php

Route::get('/', 'IndexController@index');

Route::get('login',[
    'as'=>'admin.login','uses'=>'LoginController@showLoginForm'
]);
