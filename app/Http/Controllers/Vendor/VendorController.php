<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendors\Vendor;
use Auth;
use App\Models\Regions\City;
use App\Models\Vendors\VendorQuery;

class VendorController extends Controller
{
    public function __construct(VendorQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function index(Request $request)
    {
        $vendors = Vendor::orderby('id','desc')
                    ->when($request->keyword, function ($query) use ($request) {
                             $query->where('name', 'like', "%{$request->keyword}%");
                    })->paginate(10);
        return view('vendor.index',compact("vendors"));
    }
    public function add(Request $request)
    {
       return view('vendor.add');
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('vendor.edit',compact('vendor'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2',
            'city_id' =>'required',
            'pic_phone'=>'required|max:16',
            'pic_email'=>'required|email',
            'pic_name'=>'required',
            'phone'=>'required',
            'email' => 'required|email',
            ]);

        $this->queryObject->store($request);
        logCreate(auth()->user()->id,$request->name.' - '.$request->email,'Vendor');
        return redirect()->route('vendor.index')->with('sukses','Data Berhasil disimpan');

    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|min:2',
            'city_id' =>'required',
            'pic_phone'=>'required|max:16',
            'pic_email'=>'required|email',
            'pic_name'=>'required',
            'phone'=>'required',
            'email' => 'required|email',
        ]);

        $this->queryObject->update($request,$id);
        logUpdate(auth()->user()->id,$request->name.' - '.$request->email,'Vendor');
        return redirect()->route('vendor.index')->with('sukses','Data Berhasil disimpan');
    }


    public function delete($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete($vendor);
        logCreate(auth()->user()->id,$vendor->name,'vendor');
        return redirect()->route('vendor.index')->with('sukses','Data Berhasil dihapus');
    }

}
