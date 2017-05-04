<?php

namespace App\Http\Middleware;

use App\Models\AdminPermission as Permission;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class GetSystemMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //ajax请求不需要获取菜单
        if(!$request->ajax()){
            $request->attributes->set('leftMenus', $this->getLeftMenu());
        }
        return $next($request);
    }

    /**
     * 获取左侧菜单
     */
    protected function getLeftMenu(){

        $routeName = starts_with(Route::currentRouteName(),'admin.') ? Route::currentRouteName() : 'admin.' . Route::currentRouteName();
        $url = URL::getRequest()->path();
        $table = Cache::store('file')->rememberForever('leftMenus', function(){
            return Permission::where('cid', 0)
                ->with(['children' => function($query){
                    $query->where('type', 1);
                }])->get()->toArray();
        });
        foreach ($table as $key => &$item) {
            foreach ($item['children'] as $keyChild => &$child) {
                if(!Gate::forUser(auth('admin')->user())->check($child['name'])){
                    unset($item['children'][$keyChild]);
                    continue;
                }
                if($child['name'] == $routeName || $this->compare($child['name'], $url)){
                    $child['active'] = 1;
                    $item['active'] = 1;
                }
            }
            if(!$item['children']){
                unset($table[$key]);
                continue;
            }
        }
        return $table;

    }

    private function compare($routeName, $url){
        if(is_string($routeName) && is_string($url)){
            $routeNameSub = implode('.', explode('.', $routeName, -1));
            $urlArr = explode('/', $url);
            $urlSub = '';
            if(isset($urlArr[0]) && isset($urlArr[1])){
                $urlSub = $urlArr[0] . '.' . $urlArr[1];
            }
            if($routeNameSub == $urlSub){
                return true;
            }
        }
        return false;
    }
}
