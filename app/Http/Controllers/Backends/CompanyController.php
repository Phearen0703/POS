<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CompanyController extends Controller
{
    public function index()
    {
        $data['companies'] = DB::table('companies')->find(1);
        return view('backends.company.index', $data);
    }

}
