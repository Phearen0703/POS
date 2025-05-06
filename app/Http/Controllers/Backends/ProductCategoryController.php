<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductCategoryController extends Controller
{


    public function index(){

        $data['product_categories'] = DB::table('product_categories')->paginate(10);

        return view('backends.product_categories.index', $data);
    }
}
