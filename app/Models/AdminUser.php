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

}
