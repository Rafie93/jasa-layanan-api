<?php
namespace App\Models\Vendors;

use App\Models\Vendors\Vendor;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/**
* Vendor Query Object
*/
class VendorQuery
{
    public function getVendorPluck()
    {
        return Vendor::where('is_active',1)->pluck('name','id');
    }
    public function getVendorAktif()
    {
        return Vendor::where('is_active',1)
                        ->get();
    }
    public function getVendorById($id)
    {
       return Vendor::find($id);
    }

    public function store($request)
    {
        $vendorCode = $this->generateCode();
        $vendorPhone = $request->pic_phone==null ? $request->phone : $request->pic_phone;
        DB::beginTransaction();
            $user = new \App\User;
            $user->role = '15';
            $user->phone = $vendorPhone;
            $user->username = $request->name.''.$vendorCode;
            $user->name =  $request->pic_name;
            $user->email= $request->pic_email;
            $user->password = bcrypt($vendorPhone);
            $user->ref_code = $vendorCode;
            $user->remember_token = Str::random(60);
            $user->email_verified_at = Carbon::now();
            $user->save();
            $request->merge(['user_id' => $user->id]);
            $vendor = Vendor::create($request->all());
        DB::commit();
    }
    public function update($request,$id)
    {
       DB::beginTransaction();
           $vendor = Vendor::find($id)->update($request->all());
       DB::commit();
    }

    public function generateCode()
    {
        $code = Str::random(5);
        return $code;
    }

}
