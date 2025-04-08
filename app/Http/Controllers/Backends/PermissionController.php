<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class PermissionController extends Controller
{
    public function index()
    {
        // Fetch permissions from the database
        $data['permissions'] = DB::table('permissions')->get();
 
        return view('backends.permissions.index', $data);
    }

    public function create()
    {
        return view('backends.permissions.create');
    }
}
