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
 
}
