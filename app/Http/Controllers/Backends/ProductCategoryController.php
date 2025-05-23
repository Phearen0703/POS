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
    public function create(){
        return view('backends.product_categories.create');
    }
    public function store(Request $r){
        
        $data = $r->except('_token');

        $i = DB::table('product_categories')->insert($data);
        $sms = ['status'=>'error','sms'=>'Insert Failed'];
        if($i){
            $sms = ['status'=>'success','sms'=>'Insert Success'];
        }
        return redirect()->route('admin.product_category')->with($sms);
        
    }
    public function edit($category_id){

        $data['product_category'] = DB::table('product_categories')->find($category_id);
        if(!$data['product_category']){
            return redirect()->route('admin.product_category')->with(['status'=>'error','sms'=>'Product Category not found']);
        }
        
        return view('backends.product_categories.edit', $data);
    }
    public function update(Request $r, $category_id){

        $data = $r->except('_token');

        $u = DB::table('product_categories')->where('id', $category_id)->update($data);
        $sms = ['status'=>'error','sms'=>'Update Failed'];
        if($u){
            $sms = ['status'=>'success','sms'=>'Update Success'];
        }
        return redirect()->route('admin.product_category')->with($sms);
        
    }
    public function delete($category_id){

        $find = DB::table('product_categories')->find($category_id);
        if(!$find){
            return redirect()->route('admin.product_category')->with(['status'=>'error','sms'=>'Product Category not found']);
        }
        $findBelongToProduct = DB::table('products')->where('product_category_id', $category_id)->exists();
        if($findBelongToProduct){
            return redirect()->route('admin.product_category')->with(['status'=>'warning','sms'=>'Product Category is used by Product, please delete the product first']);
        }
        $d = DB::table('product_categories')->where('id', $category_id)->delete();
        $sms = ['status'=>'error','sms'=>'Delete Failed'];
        if($d){
            $sms = ['status'=>'success','sms'=>'Delete Success'];
        }
        return redirect()->route('admin.product_category')->with($sms);
        
    }
}
