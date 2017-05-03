<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    //
    protected $table = 'admin_permission';

    protected $guarded = [];


    public function roles(){
        return $this->belongsToMany('App\Models\AdminRole','admin_role_permission','permission_id','role_id');
    }
}
