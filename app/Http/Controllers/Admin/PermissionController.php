<?php

namespace App\Http\Controllers\Admin;

use App\Events\MenuChangeEvent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminPermission as Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $cid
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $cid = 0)
    {
        $permission = Permission::find($cid);
        if($request->ajax()){
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $cid = $request->input('cid', 0);
            $data['recordsTotal'] = Permission::where('cid',$cid)->count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Permission::where('cid',$cid)->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('label', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Permission::where('cid',$cid)->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('label', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Permission::where('cid',$cid)->count();
                $data['data'] = Permission::where('cid',$cid)->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }
            return response()->json($data);
        }
        return view('admin.permission.index',['cid'=>$cid,'permission'=>$permission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $cid
     * @return \Illuminate\Http\Response
     */
    public function create($cid = 0)
    {
        $data = [];
        $data['cid'] = $cid;
        $data['permission'] = null;
        return view('admin.permission.create',$data);

//        dd(old('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\AdminPermissionCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminPermissionCreateRequest $request)
    {
        $data = $request->input('permission');
        try{
            $permission = Permission::create($data);
            if($permission->cid){
                $redirect_url = 'admin/permission/'.$permission->cid .'/list';
            }else{
                $redirect_url = 'admin/permission/';
            }
            event(new MenuChangeEvent());
            return redirect($redirect_url)->with('success','添加成功 !');
        }catch(\Exception $e){
            return redirect()->back()->with('error','系统出错,添加失败 !');
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
        $data = [];
        $permission = Permission::with('children')->find($id);
        if(!$permission){
            abort(404);
        }
        $data['permission'] = $permission;
        return view('admin.permission.show',$data);
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
        $permission = Permission::find($id);
        if(!$permission){
            abort(404);
        }
        $data['id'] = $id;
        $data['permission'] = $permission;
        return view('admin.permission.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdminPermissionUpdateRequest $request, $id)
    {
        $data = $request->input('permission');
        $permission = Permission::find($id);
        try{
            $permission->update($data);
            if($permission->cid){
                $redirect_url = 'admin/permission/'.$permission->cid.'/list';
            }else{
                $redirect_url = 'admin/permission/';
            }
            event(new MenuChangeEvent());
            return redirect($redirect_url)->with('success','更新成功 !');
        }catch(\Exception $e){
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
        $children = Permission::where('cid',$id)->get();
        if(!$children->isEmpty()){
            return redirect()->back()->with('error','请先将该权限的子权限删除后再做删除操作!');
        }
        DB::beginTransaction();
        try{
            $permission = Permission::find($id);
            $permission->roles()->detach();
            $permission->delete();
            DB::commit();
            if($permission->cid){
                $redirect_url = 'admin/permission/'.$permission->cid.'/list';
            }else{
                $redirect_url = 'admin/permission';
            }
            event(new MenuChangeEvent());
            return redirect($redirect_url)->with('success','删除成功 !');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','系统出错,删除失败');
        }
    }
}
