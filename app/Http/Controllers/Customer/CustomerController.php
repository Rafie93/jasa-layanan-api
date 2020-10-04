<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerStatic;
use Auth;
use App\Models\Regions\City;
use App\Models\Customer\CustomerQuery;

class CustomerController extends Controller
{
    public function __construct(CustomerQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function index(Request $request)
    {
        $customers = Customer::orderby('id','desc')
                    ->when($request->filterKategori, function ($query) use ($request) {
                        $query->where('category_user', '=', "{$request->filterKategori}");
                    })
                    ->when($request->keyword, function ($query) use ($request) {
                             $query->where('name', 'like', "%{$request->keyword}%");
                    })->paginate(10);

        return view('customer.index',compact("customers"));
    }

    public function add(Request $request)
    {
       $category = CustomerStatic::all();
       return view('customer.add',compact("category"));
    }

    public function edit($id)
    {
        $category = CustomerStatic::all();
        $customer = Customer::find($id);
        return view('customer.edit',compact("category",'customer'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2',
            'code' => 'max:10',
            'category_user' => 'required',
            'orig_city_id' =>'required',
            'phone_customer'=>'required|max:16',
            'email_customer'=>'required',
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users',
            'password'=>'required',
            'postal_code' => 'max:5',
            ]);

        $this->queryObject->store($request);
        logCreate(auth()->user()->id,$request->name.' - '.$request->email,'Customer');
        return redirect()->route('customer.index')->with('sukses','Data Berhasil disimpan');

    }

    public function update(Request $request,$id)
    {
        $user_id = Customer::find($id)->first()->user_id;
        $this->validate($request,[
            'name' => 'required|min:2',
            'code' => 'max:10',
            'category_user' => 'required',
            'orig_city_id' =>'required',
            'phone_customer'=>'required|max:16',
            'email_customer'=>'required',
            'email'=>'required|email|unique:users,email,'.$user_id,
            'username'=>'required|unique:users,username,'.$user_id,
            'postal_code' => 'max:5',
        ]);

        $this->queryObject->update($request,$id,$user_id);
        logUpdate(auth()->user()->id,$request->name.' - '.$request->email,'Customer');
        return redirect()->route('customer.index')->with('sukses','Data Berhasil disimpan');
    }

    public function detail($id)
    {
        $customer = Customer::where('id',$id)->first();
        $tarifs = Rate::where('customer_id',$customer->id)->paginate(20);
        $awbs = Awb::where('customer_id',$customer->id)->paginate(20);
        $invoices = Invoice::where('customer_id',$customer->id)->paginate(20);
        return view('customer.detail',compact('customer','tarifs','awbs','invoices'));
    }

    public function delete($id)
    {
        $customer = customer::findOrFail($id);
        $customer->delete($customer);
        logCreate(auth()->user()->id,$customer->name,'Customer');
        return redirect()->route('customer.index')->with('sukses','Data Berhasil dihapus');
    }
}
