<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    //
    protected $table = 'admin_user';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function roles(){
        return $this->belongsToMany('App\Models\AdminRole','admin_user_role','user_id','role_id');
    }

    //判断用户是否有某一权限
    public function hasPermission($permission){
        if(is_string($permission)){
            $permission = AdminPermission::where('name',$permission)
                ->orWhere('name','like','%#'.$permission)
                ->orWhere('name','like',$permission.'#%')
                ->first();
            if(!$permission){
                return false;
            }
        }
        return $this->hasRole($permission->roles);
    }

    //判断用户是否有某一角色
    public function hasRole($role){
        if(is_string($role)){
            return $this->roles->contains('name',$role);
        }
        return !!$role->intersect($this->roles)->all();
    }
}
