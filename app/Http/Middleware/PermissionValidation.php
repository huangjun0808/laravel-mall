<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class PermissionValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //id为1的超级管理员拥有所有权限
        if(auth('admin')->user()->id === 1){
            return $next($request);
        }
        $previousUrl = URL::previous();
        //当前访问网址的路由名称
        $routeName = starts_with(Route::currentRouteName(),'admin.') ? Route::currentRouteName() : 'admin.' . Route::currentRouteName();
        if(!Gate::forUser(auth('admin')->user())->check($routeName)){
            if ($request->ajax() && ($request->getMethod() != 'GET')) {
                return response()->json([
                    'status' => -1,
                    'code'   => 403,
                    'msg'    => '您没有权限执行此操作',
                ]);
            } else {
                return response()->view('admin.errors.403', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}
