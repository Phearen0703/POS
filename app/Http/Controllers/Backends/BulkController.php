<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;
use DB;

class BulkController extends Controller
{
    public function store(Request $r){


        $validator = Validator::make($r->all(),[
            'tbl' => 'required',
            'per' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'errors',
                'data' => $validator->errors(),
            ]);
        }
        if(!ckeckPermission($per, 'create')){
            return redirect()->route('admin.no_permission')->with([
                'status' => 'warning',
                'sms' => 'You do not have permission to access this page',
            ]);
        }

        $data = $r->except('_token', 'photo');
        if($r->hasFile('photo')){
            $data['photo'] = $r->file('photo')->store('images/'.$r->tbl, 'custom');
        }

        $i = DB::table($tbl)->insert($data);
        if($i){
            return redirect()->back()->with([
                'status' => 'success',
                'sms' => 'Data Inserted Successfully',
            ]);

        }
        return redirect()->back()->with([
                'status' => 'error',
                'sms' => 'Data Inserted Failed',
            ]);
    }

    public function update(Request $r, $bulk_id){
        $validator = Validator::make($r->all(),[
            'tbl' => 'required',
            'per' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'errors',
                'data' => $validator->errors(),
            ]);
        }

        // Check if the user has permission to edit
        if(!ckeckPermission($per, 'edit')){
            return redirect()->route('admin.no_permission')->with([
                'status' => 'warning',
                'sms' => 'You do not have permission to access this page',
            ]);
        }


        //find table name
        $find = DB::table($r->tbl)->find($bulk_id);
        if(!$find){
            return redirect()->route('admin.no_permission')->with([
                'status' => 'error',
                'sms' => 'Data Not Found',
            ]);
        }

        //check photo
        $data = $r->except('_token', 'photo');
        if($r->hasFile('photo')){
            $data['photo'] = $r->file('photo')->store('images/'.$r->tbl, 'custom');
            if(Storage::disk('custom')->exists($find->photo)){
                Storage::disk('custom')->delete($find->photo);
            }
        }


        $u = DB::table($tbl)->wheres('id',$bulk_id)->update($data);
        if($u){
            return redirect()->back()->with([
                'status' => 'success',
                'sms' => 'Data update Successfully',
            ]);

        }
        return redirect()->back()->with([
                'status' => 'error',
                'sms' => 'Data update Failed',
            ]);
    }

    public function delete($bulk_id){
        $validator = Validator::make($r->all(),[
            'tbl' => 'required',
            'per' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'errors',
                'data' => $validator->errors(),
            ]);
        }

        // Check if the user has permission to edit
        if(!ckeckPermission($per, 'delete')){
            return redirect()->route('admin.no_permission')->with([
                'status' => 'warning',
                'sms' => 'You do not have permission to access this page',
            ]);
        }


        //find table name
        $find = DB::table($r->tbl)->find($bulk_id);
        if(!$find){
            return redirect()->route('admin.no_permission')->with([
                'status' => 'error',
                'sms' => 'Data Not Found',
            ]);
        }

        //check photo
        $data = $r->except('_token', 'photo');
            if(Storage::disk('custom')->exists($find->photo)){
                Storage::disk('custom')->delete($find->photo);
            }
        


        $d = DB::table($tbl)->wheres('id',$bulk_id)->update($data);
        if($d){
            return redirect()->back()->with([
                'status' => 'success',
                'sms' => 'Data update Successfully',
            ]);

        }
        return redirect()->back()->with([
                'status' => 'error',
                'sms' => 'Data update Failed',
            ]);
    }
}
