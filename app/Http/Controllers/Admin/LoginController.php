<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
    protected $username;

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /**
     *  重写登录视图
     */
    public function showLoginForm(){
        return view('admin.auth.login');
    }

}
