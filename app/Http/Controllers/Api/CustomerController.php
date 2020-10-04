<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
class CustomerController extends Controller
{
    //
    public function pic(Request $request)
    {
        $customerCustomer = Customer::select('name_customer as name','phone_customer as phone','email_customer as email','address')
                                        ->where('id',$request->customer_id)->get();

        return response()->json([ 'success' => true,'pic' => $customerCustomer->first()],200);

    }
}
