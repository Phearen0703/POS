<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
class UserController extends Controller
{
    public function index(){

        $data['users'] = DB::table('users')->paginate(10);

        return view('backends.users.index',$data);
    }

    public function create(){
        return view('backends.users.create');
    }

    public function store(Request $r){

        $name = $r->name;
        $username = $r->username;
        $password = Hash::make($r->password);

        $i = DB::table('users')->insert([
            'name' => $name,
            'username' => $username,
            'password' => $password,
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
