<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerGeneralInfo;


class CustomerController extends Controller
{
    public function index() {

        $customer = Customer::join('customer_general_infos', 'customers.id', '=' ,'customer_general_infos.customer_id')
                              ->get();
        
        return $customer;

    }


    public function store(Request $request)
    {
       
        Customer::create($request->all());
        CustomerGeneralInfo::create($request->all());

    }



    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        

        $inputs = $request->all();
        $customer->update($inputs);
        $customer->customer_general_info->update($inputs);

    }


    public function delete($id)
    {
        $customer = Customer::findOrFail($id); 
        $customer->delete();
    }
}
