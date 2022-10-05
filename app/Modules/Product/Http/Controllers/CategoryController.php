<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Product\Models\ProductRelation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // To show all Category
    public function index(){
        $category = DB::table('product_relations as parent')
                    ->join('product_relations as child', 'child.parent_id', 'parent.id')
                    ->select(
                        'parent.name AS brand_name',
                        'child.name AS category_name',
                        'child.slug AS slug',
                        'child.status AS status',
                        'child.id AS id'
                    )
                    ->where('child.type','category')
                    ->where('parent.type','brand')
                    ->paginate(10);
                    // echo "<pre>";
                    // print_r($category);
        return view('Product::category.index',compact('category'));
    }

    // To create new product
    public function create(){
        $brands = ProductRelation::where('type','brand')
                  ->where('status','active')
                  ->pluck('name','id')
                  ->all();
        // print_r($brands);
        return view('Product::category.create',compact('brands'));
    }

     // To store new category
     public function store(Request $request){
        $type = 'category';
        $validated = $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);
        ProductRelation::insert([
        'parent_id' => $request->parent_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'type' => $type,
        'status' => $request->status,
        ]);
        $notification = ['message' => 'Category Added Successfully', 'alert-type' => 'success'];
        return redirect()->route('category.index')->with($notification);
    }

    // To delete a brand
    public function destroy($id){
        $brand = ProductRelation::find($id);
        $brand->delete();
        $notification = ['message' => 'Category Deleted successfully', 'alert-type' => 'success'];
        return redirect()->route('category.index')->with($notification);
        
    }

    // To edit a brand
    public function edit($id){
        $category = DB::table('product_relations as parent')
                    ->join('product_relations as child', 'child.parent_id', 'parent.id')
                    ->select(
                        'parent.name AS brand_name',
                        'child.name AS name',
                        'child.slug AS slug',
                        'child.status AS status',
                        'child.id AS id',
                        'child.parent_id AS parent_id'
                    )
                    ->where('child.type','category')
                    ->where('parent.type','brand')
                    ->where('child.status','active')
                    ->where('parent.status','active')
                    ->where('child.id',$id)
                    ->first();
        $brands = DB::table('product_relations as parent')
                  ->where('parent.type','brand')
                  ->where('parent.status','active')
                  ->pluck('parent.name','parent.id')
                  ->all();

        // $brand_select = DB::table('product_relations')
        // ->where('id', $category->parent_id)
        // ->where('type', 'brand')
        // ->where('status', 'active')
        // ->first();
        // echo "<pre>";
        // print_r($brand_select);
        return view('Product::category.edit',compact('category','brands'));
    }

    // To update category
    public function update(Request $request,$id){
        $type = 'category';
        $validated = $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);
        ProductRelation::where('id',$id)->update([
        'parent_id' => $request->parent_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'type' => $type,
        'status' => $request->status,
        ]);
        $notification = ['message' => 'Category Updated Successfully', 'alert-type' => 'success'];
        return redirect()->route('category.index')->with($notification);
    }
}
