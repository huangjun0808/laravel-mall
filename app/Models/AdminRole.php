<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    //
    protected $table = 'admin_role';

    protected $guarded = [];

    public function permissions(){
        return $this->belongsToMany('App\Models\AdminPermission','admin_role_permission','role_id','permission_id');
    }
}
