<?php
    function checkPermission($permission_key, $action){
       $role_id = auth()->user()->role_id;
       $permission = DB::table('permissions')->where('alias', $permission_key)->first();
       if(!$permission){
           return false;
       }
       $role_permission = DB::table('role_permissions')->where([
           'role_id' => $role_id,
           'permission_id' => $permission->id
       ])->first();

         if(!$role_permission){
              return false;
         }

         if($action == 'view'){
                return $role_permission->list == 1 ? true : false;
         }else if($action == 'create'){
                return $role_permission->insert == 1 ? true : false;
         }else if($action == 'edit'){
                return $role_permission->update == 1 ? true : false;
         }else{
                return $role_permission->delete == 1 ? true : false;
         }

    }

    function userAuth(){
        $user_id = auth()->user()->id;
        $user = DB::table('users')->find($user_id);
        return $user;
    }

    function company(){
        
        return  DB::table('companies')->find(1);
    }
?>