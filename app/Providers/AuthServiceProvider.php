<?php

namespace App\Providers;

use App\Models\AdminPermission as Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $gate->before(function($user) {
            if($user->id == 1){
                return true;
            }
        });
        $this->registerPolicies();
        //渴求式加载(两次查询操作)
        $permissions = Permission::with('roles')->get();
        foreach($permissions as $permission){
            $gate->define($permission->name, function($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

    }
}
