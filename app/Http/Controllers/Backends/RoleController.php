<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class RoleController extends Controller
{
    public function index(){

        $data['roles'] = DB::table('roles')->paginate(10);

        return view('backends.roles.index');
    }
}
