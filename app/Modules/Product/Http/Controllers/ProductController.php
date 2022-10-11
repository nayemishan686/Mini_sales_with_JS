<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\ProductRelation;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Product::welcome");
    }

    // To show all product
    public function index(){
        $product = DB::table('products')
                ->join('product_relations as brand','brand.id', 'products.brand_id')
                ->join('product_relations as cat','cat.id','products.category_id')
                ->select('products.*','brand.name as brand_name','cat.name as category_name')
                ->paginate(10);
        return view('Product::product.index',compact('product'));
    }

    // To create new product
    public function create()
    {
        $brands = ['' => 'Please Select Brand'] + ProductRelation::where('type', 'brand')
            ->where('status', 'active')
            ->pluck('name', 'id')
            ->all();

        $categories = ProductRelation::where('type', 'category')
            ->where('status', 'active')
            ->pluck('name', 'id')
            ->all();
        return view('Product::product.create', compact('brands', 'categories'));
    }

    // To store new Product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $slug = Str::slug($request->name, '-');
        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = $slug;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;
        $data['status'] = $request->status;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['quantity'] = $request->quantity;
        $data['description'] = $request->description;

        $image = $request->image;
        $imageName = $slug . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(600, 600)->save('files/products/' . $imageName);
        $data['image'] = 'files/products/' .$imageName;
        DB::table('products')->insert($data);
        $notification = ['message' => 'Product Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
        // echo "<pre>";
        // print_r($imageName);
    }

    // To delete Product
    public function destroy($id){
        $data = DB::table('products')->where('id',$id)->first();
        $image = $data->image;
        if(File::exists($image)){
            unlink($image);
        }
        DB::table('products')->where('id',$id)->delete();
        $notification = ['message' => 'Product Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
        echo "<pre>";
        // print_r($image);
    }

    // To edit Product Page
    public function edit($id){
        $product = DB::table('products')->where('id',$id)->first();
        $brands = ['' => 'Please Select Brand'] + ProductRelation::where('type', 'brand')
            ->where('status', 'active')
            ->pluck('name', 'id')
            ->all();
        $categories = ProductRelation::where('type', 'category')
            ->where('status', 'active')
            ->pluck('name', 'id')
            ->all();
        return view('Product::product.edit',compact('product','brands','categories'));
    }

    // To update Product
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);
        $slug = Str::slug($request->name, '-');
        $data = [];
        $data['name'] = $request->name;
        $data['slug'] = $slug;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;
        $data['status'] = $request->status;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['quantity'] = $request->quantity;
        $data['description'] = $request->description;
        if($request->image){
            if(File::exists($request->old_image)){
                unlink($request->old_image);
            }
            $image = $request->image;
            $imageName = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save('files/products/' . $imageName);
            $data['image'] = 'files/products/' .$imageName;
            DB::table('products')->where('id',$id)->update($data);
            $notification = ['message' => 'Product Updated Successfully', 'alert-type' => 'success'];
            return redirect()->route('product.index')->with($notification);
        }else{
            $data['image'] = $request->old_image;
            DB::table('products')->where('id',$id)->update($data);
            $notification = ['message' => 'Product Updated Successfully', 'alert-type' => 'success'];
            return redirect()->route('product.index')->with($notification);
        }
        // echo "<pre>";
        // print_r($request->all());
    }

    // to find category
    public function getCategory($id)
    {
        $data = DB::table('product_relations')->where('parent_id', $id)->get();
        return response()->json($data);
    }
}
