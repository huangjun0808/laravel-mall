<?php

    Route::group(['middleware'=>'wechat.oauth'], function(){
        Route::get('/',function(){
            $user = session('wechat.oauth_user'); // 拿到授权用户资料
            dump($user);
        });
    });

