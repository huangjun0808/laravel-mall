<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminRole as Role;
use App\Models\AdminPermission as Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Role::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Role::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Role::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Role::count();
                $data['data'] = Role::skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['role'] = null;
        $permissions = Permission::all()->toArray();
        foreach($permissions as $permission){
            if($permission['cid']==0){
                $data['permissions'][$permission['id']] = $permission;
            }else{
                $data['permissions'][$permission['cid']]['children'][] = $permission;
            }
        }
        return view('admin.role.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminRoleCreateRequest $request)
    {
        $data = $request->input('role');
        $permissions = $request->input('permission',[]);
        DB::beginTransaction();
        try{
            $role = Role::create($data);
            $role->permissions()->sync($permissions);
            DB::commit();
            return redirect('admin/role')->with('success','添加成功 !');
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
        $role = Role::find($id);
        if(!$role){
            abort(404);
        }
        $data['role'] = $role->toArray();
        $permissions = Permission::all()->toArray();
        foreach($permissions as $permission){
            if($permission['cid']==0){
                $data['permissions'][$permission['id']] = $permission;
            }else{
                $data['permissions'][$permission['cid']]['children'][] = $permission;
            }
        }
        $role_permissions = $role->permissions->toArray();
        foreach($role_permissions as $role_permission){
            $data['role_permissions'][] = $role_permission['id'];
        }
        return view('admin.role.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdminRoleUpdateRequest $request, $id)
    {
        $data = $request->input('role');
        $permissions = $request->input('permission',[]);
        $role = Role::find($id);
        DB::beginTransaction();
        try{
            $role->update($data);
            $role->permissions()->detach();
            $role->permissions()->sync($permissions);
            DB::commit();
            return redirect('admin/role')->with('success','更新成功 !');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','系统出错,更新失败');
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
    }
}
