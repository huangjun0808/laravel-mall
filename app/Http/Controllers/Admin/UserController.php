<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminRole as Role;
use Illuminate\Http\Request;
use App\Models\AdminUser as User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = User::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = User::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('email', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = User::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('email', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = User::count();
                $data['data'] = User::skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $roles = Role::all()->toArray();
        $data['roles'] = $roles;
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminUserCreateRequest $request)
    {
        $data = $request->input('user');
        $roles = $request->input('role',[]);
        $data['password'] = bcrypt($data['password']);
        unset($data['password_confirmation']);
        DB::beginTransaction();
        try{
            $user = User::create($data);
            $user->roles()->sync($roles);
            DB::commit();
            return redirect('admin/user')->with('success','添加成功 !');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','系统出错,添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return 'show';

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $data['user'] = $user->toArray();
        $data['roles'] = Role::all()->toArray();
        $user_roles = $user->roles->toArray();
        foreach($user_roles as $user_role){
            $data['user_roles'][] = $user_role['id'];
        }
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdminUserUpdateRequest $request, $id)
    {
        $data = $request->input('user');
        $roles = $request->input('role',[]);
        $user = User::find($id);
        DB::beginTransaction();
        try{
            if($data['password'] && $data['password_confirmation']){
                $data['password'] = bcrypt($data['password']);
                unset($data['password_confirmation']);
                $user->update($data);
            }
            if($id != 1){
                $user->roles()->detach();
                $user->roles()->sync($roles);
            }
            DB::commit();
            return redirect('admin/user')->with('success','更新成功 !');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','系统出错,更新失败 !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return 'destroy';

    }
}
