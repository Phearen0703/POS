<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class RoleController extends Controller
{
    public function index(){
      



        $data['roles'] = DB::table('roles')->paginate(10);

        return view('backends.roles.index',$data);
    }

    public function create(){
        return view('backends.roles.create');
    }

    public function store(Request $r){

        $name = $r->name;

        $i = DB::table('roles')->insert([
            'name' => $name,
            'created_at' => date('Y-m-d-H:i:s')
        ]);

        if($i == true){
            return redirect()->route('admin.role')->with(['status'=>'success', 'sms'=>__('Insert Successfully')]);
        }else{
            return redirect()->route('admin.role')->with(['status'=>'error','sms'=>__('Insert Fails')]);
        }
    }

    public function edit($role_id){
        $data['role'] = DB::table('roles')->find($role_id);

        return view('backends.roles.edit', $data);
    }

    public function update(Request $r, $role_id){
        $u = DB::table('roles')->where('id', $role_id)->update([
            'name'=>$r->name
        ]);
        if($u == true){
            return redirect()->route('admin.role')->with(['status'=>'success', 'sms'=>__('Update Successfully')]);
        }else{
            return redirect()->route('admin.role')->with(['status'=>'warning','sms'=>__('No Update')]);
        }
    }

    public function delete($role_id){

        $find = DB::table('users')->where('role_id', $role_id)->exists();
        if($find){
            return redirect()->route('admin.role')->with(['status'=>'warning', 'sms'=>__('This role is used by user! Can not delete, please delete user first')]);
        }

        $d = DB::table('roles')->where('id', $role_id)->delete();

        if($d == true){
            return redirect()->route('admin.role')->with(['status'=> 'success', 'sms' => __('Delete Successfully')]);
        }else{
            return redirect()->route('admin.role')->with(['status'=> 'success', 'sms' => __('Delete Unsuccessfully')]);
        }
    }

    public function permission($role_id){
        
        $data['role_permissions'] = DB::table('permissions')
        ->leftJoinSub(
            DB::table('role_permissions')->where('role_id', $role_id),'t1', function($join){
                $join->on('t1.permission_id', 'permissions.id');
            }
        )

        ->select(
            'permissions.*',
            DB::raw('IFNULL(t1.list,0) as list'),
            DB::raw('IFNULL(t1.insert,0) as store'),
            DB::raw('IFNULL(t1.update,0) as edit'),
            DB::raw('IFNULL(t1.delete,0) as remove'),
            DB::raw('IFNULL(t1.id,0) as role_permission_id'),

        )
        ->get();

        $data['role_id'] = $role_id;
        
        return view('backends.roles.permissions.index', $data);
    }
 
    public function updatePermission(Request $r, $role_id){
        $role_permission_name = $r->permission;
        $role_permission_id = $r->role_permission_id;
        $role_permission_value = $r->role_permission_value;
        $permission_id = $r->permission_id;
        
        try{
            if($role_permission_id == 0){
                DB::table('role_permissions')->insert([
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                    'list' => $role_permission_name == 'list' ? $role_permission_value : 0,
                    'update' => $role_permission_name == 'edit' ? $role_permission_value : 0,
                    'insert' => $role_permission_name == 'store' ? $role_permission_value : 0,
                    'delete' => $role_permission_name == 'remove' ? $role_permission_value : 0,
                ]);
            }else{
                $data = [];
                if($role_permission_name == 'list'){
                    $data['list'] = $role_permission_value;
                }else if($role_permission_name == 'edit'){
                    $data['update'] = $role_permission_value;
                }else if($role_permission_name == 'store'){
                    $data['insert'] = $role_permission_value;
                }else if($role_permission_name == 'remove'){
                    $data['delete'] = $role_permission_value;
                }
                DB::table('role_permissions')->where([
                    'id' => $role_permission_id,
                    'role_id' => $role_id,
                    'permission_id' => $permission_id
                ])->update($data);
            }

        }catch(\Exception $e){
            return redirect()->route('admin.role.permission', ['role_id'=>$role_id])->with(['status'=>'error', 'sms'=>__('Update Fails')]);
        }

        return redirect()->route('admin.role.permission', ['role_id'=>$role_id])->with(['status'=>'success', 'sms'=>__('Update Successfully')]);
    }
}
