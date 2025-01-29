<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
class UserController extends Controller
{
    public function index(){

        $data['users'] = DB::table('users')
        ->join('roles', 'roles.id', 'users.role_id')
        ->select('users.*', 'roles.name as role_name')
        
        ->paginate(10);

        return view('backends.users.index',$data);
    }

    public function create(){

        $data['roles'] = DB::table('roles')->get();
        return view('backends.users.create',$data);
    }

    public function store(Request $r){

        $vilidation = validator::make($r->all(),[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'role_id' => 'required|numeric'

        ]);

        if($vilidation->fails()){
            return redirect()->route('admin.user')->with(['status'=>'errors', 'data' => $vilidation->errors()]);
        }

        $name = $r->name;
        $username = $r->username;
        $password = Hash::make($r->password);
        $email = $r->email;
        $role_id = $r->role_id;

        $i = DB::table('users')->insert([
            'name' => $name,
            'role_id' => $role_id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'created_at' => date('Y-m-d-H:i:s')
        ]);

        if($i == true){
            return redirect()->route('admin.user')->with(['status'=>'success', 'sms'=>__('Insert Successfully')]);
        }else{
            return redirect()->route('admin.user')->with(['status'=>'error','sms'=>__('Insert Fails')]);
        }
    }

    public function edit($user_id){
        $data['user'] = DB::table('users')->find($user_id);
        $data['roles'] = DB::table('roles')->get();

        return view('backends.users.edit', $data);
    }

    public function update(Request $r, $user_id){
        $data = [
            'name'=>$r->name,
            'username' => $r->username,
        ];

        if($r-> password){
            $data['password']= Hash::make($r->password);
        }

        $u = DB::table('users')->where('id', $user_id)->update($data);
        if($u == true){
            return redirect()->route('admin.user')->with(['status'=>'success', 'sms'=>__('Update Successfully')]);
        }else{
            return redirect()->route('admin.user')->with(['status'=>'warning','sms'=>__('No Update')]);
        }
    }

    public function delete($user_id){
        $d = DB::table('users')->where('id', $user_id)->delete();

        if($d == true){
            return redirect()->route('admin.user')->with(['status'=> 'success', 'sms' => __('Delete Successfully')]);
        }else{
            return redirect()->route('admin.user')->with(['status'=> 'success', 'sms' => __('Delete Unsuccessfully')]);
        }
    }
}
