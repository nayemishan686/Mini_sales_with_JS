<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\ProductRelation;
use Illuminate\Support\Facades\DB;

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
        return view('Product::product.create', compact('brands','categories'));
    }

    // to find category
    public function getCategory($id) {
        $data = DB::table('product_relations')->where('parent_id', $id)->get();
        // $data = "hi";
        return response()->json($data);
    }
}
