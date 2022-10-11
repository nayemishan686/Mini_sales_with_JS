<?php

namespace App\Modules\POS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class POSController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("POS::welcome");
    }

    // To create New sales
    public function create()
    {
        $customer = DB::table('customers')->get();
        return view('POS::pos.create', compact('customer'));
    }

    // To get data
    public function getData($id)
    {
        $data = DB::table('customers')->where('id', $id)->first();
        return response()->json($data);
    }

    // Store Customer By ajax
    public function ajaxStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $data = [];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['status'] = $request->status;
            $productId = DB::table('customers')->insertGetId($data);
            $datam = DB::table('customers')->where('id',$productId)->first();
            return response()->json($datam);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
}
