<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Str;
use App\Modules\Product\Models\ProductRelation;

class BrandController extends Controller
{
    // To show all brand
    public function index(){
        $brand = ProductRelation::where('type','brand')->select('product_relations.*')->paginate(10);
        return view('Product::brand.index',compact('brand'));
    }

    // To create new product
    public function create(){
        return view('Product::brand.create');
    }

    // To store new brand
    public function store(Request $request){
        $type = 'brand';
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        ProductRelation::insert([
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'type' => $type,
        'status' => $request->status,
        ]);
        $notification = ['message' => 'Brand Added Successfully', 'alert-type' => 'success'];
        return redirect()->route('brand.index')->with($notification);
    }

    // To delete a brand
    public function destroy($id){
        $brand = ProductRelation::find($id);
        $brand->delete();
        $notification = ['message' => 'Brand Deleted successfully', 'alert-type' => 'success'];
        return redirect()->route('brand.index')->with($notification);
        
    }

    // To edit a brand
    public function edit($id){
        $brand = ProductRelation::find($id);
        return view('Product::brand.edit',compact('brand'));
    }

    // To store new brand
    public function update(Request $request, $id){
        $type = 'brand';
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        ProductRelation::where('id',$id)->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'type' => $type,
        'status' => $request->status,
        ]);
        $notification = ['message' => 'Brand Added Successfully', 'alert-type' => 'success'];
        return redirect()->route('brand.index')->with($notification);
    }
}
