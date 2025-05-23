<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
    public function index(Request $r){

        $search = $r->search;

        $data['products'] = DB::table('products')
        ->join('product_categories','product_categories.id','products.product_category_id')
        ->when($search, function($query) use ($search){
            $query->where('products.name','like','%'.$search.'%');
            $query->orWhere('product_categories.name','like','%'.$search.'%');
            $query->orWhere('products.price','like','%'.$search.'%');
            })
        ->select('products.*','product_categories.name as product_category_name')
        ->paginate(10);
        return view('backends.products.index', $data);
    }
    public function create(){
        $data['product_categories'] = DB::table('product_categories')->get();
        return view('backends.products.create', $data);
    }
    public function store(Request $r){
        $r->validate([
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
       $data = $r->except('_token');

        $i = DB::table('products')->insert($data);
        $sms = ['status'=>'error','sms'=>'Insert Failed'];
        if($i){
            $sms = ['status'=>'success','sms'=>'Insert Success'];
        }
        return redirect()->route('admin.product')->with($sms);
    }
    
    public function edit($product_id){
       $find = DB::table('products')->find($product_id);
        if(!$find){
            return redirect()->route('admin.product')->with(['status'=>'error','sms'=>'Product not found']);
        }
        $cat = DB::table('product_categories')->get();
        return view('backends.products.edit', ['product'=>$find, 'product_categories'=>$cat]);
    }
    
    public function update(Request $r, $product_id){
        $r->validate([
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        
        $find = DB::table('products')->find($product_id);
        if(!$find){
            return redirect()->route('admin.product')->with(['status'=>'error','sms'=>'Product not found']);
        }

        $u = DB::table('products')->where('id', $product_id)->update($r->except('_token'));
       
        if($u){
            return redirect()->route('admin.product')->with(['status'=>'success','sms'=>'Update Success']);
        }
        return redirect()->route('admin.product')->with(['status'=>'error','sms'=>'Update Failed']);
    }
    public function delete($product_id){
        $find = DB::table('products')->find($product_id);
        if(!$find){
            return redirect()->route('admin.product')->with(['status'=>'error','sms'=>'Product not found']);
        }
        $d = DB::table('products')->where('id', $product_id)->delete();
        $sms = ['status'=>'error','sms'=>'Delete Failed'];
        if($d){
            $sms = ['status'=>'success','sms'=>'Delete Success'];
        }
        return redirect()->route('admin.product')->with($sms);
    }

}
