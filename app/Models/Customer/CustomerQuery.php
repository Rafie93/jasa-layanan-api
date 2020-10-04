<?php
namespace App\Models\Customer;

use App\Models\Customer\Customer;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/**
* Customer Query Object
*/
class CustomerQuery
{
    public function getCustomerPluck()
    {
        return Customer::where('is_active',1)->pluck('name','id','category');
    }
    public function getCustomerAktif()
    {
        return Customer::where('is_active',1)
                        ->get();
    }
    public function getCustomerById($id)
    {
       return Customer::find($id);
    }

    public function store($request)
    {
        DB::beginTransaction();
            $user = new \App\User;
            $user->role = '11';
            $user->phone = $request->phone_customer;
            $user->username = $request->username;
            $user->name =  $request->name_customer;
            $user->email= $request->email;
            $user->birthday= $request->birthday;
            $user->password = bcrypt($request->password);
            $user->ref_code = $this->generateCode();
            $user->remember_token = Str::random(60);
            $user->email_verified_at = Carbon::now();
            $user->save();

            $request->merge(['user_id' => $user->id]);
            $customer = Customer::create($request->all());
        DB::commit();
    }
    public function update($request,$id,$userId)
    {
       $userData = array(
        'username' => $request->username,
        'email' => $request->email,
        'birthday'=> $request->birthday
       );
       if($request->password!='' || $request->password!=null){
         array_merge($userData,['password'=>bcrypt($request->password)]);
       }
       DB::beginTransaction();
           $user = User::where('id',$userId)->update($userData);
           $customer = Customer::find($id)->update($request->all());
       DB::commit();
    }

    public function generateCode()
    {
        $code = Str::random(5);
        return $code;
    }

}
