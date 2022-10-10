<?php

namespace App\Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Modules\Customer\Models\Customer;

class CustomerController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */


    // To show all customer
    public function index(){
        $customer = DB::table('customers')
                ->paginate(10);
        return view('Customer::customer.index',compact('customer'));
    }

    // To Create new Customer
    public function create()
    {
        return view("Customer::customer.create");
    }

    // To store Customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['status'] = $request->status;
        DB::table('customers')->insert($data);
        $notification = ['message' => 'Customer Added Successfully', 'alert-type' => 'success'];
        return redirect()->route('customer.index')->with($notification);
    }

    // To edit Customer
    public function edit($id){
        $customer = DB::table('customers')->where('id',$id)->first();
        return view("Customer::customer.edit",compact('customer'));
    }

    // To store Customer
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['status'] = $request->status;
        DB::table('customers')->where('id',$id)->update($data);
        $notification = ['message' => 'Customer Updated Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // To delete Product
    public function destroy($id){
        DB::table('customers')->where('id',$id)->delete();
        $notification = ['message' => 'Customer Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
