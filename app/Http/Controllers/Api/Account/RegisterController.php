<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\User;
use App\Models\Sistems\Point;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public $successStatus = 200;
    public function register(RegisterRequest $request)
    {
        $newMember = Point::where('code','NM01')->first()->point;
        $pointRef = $this->cekRefcode($request->join_ref_code);
        $total_point = $newMember+$pointRef;
        $code =$this->generateCode();
        try
        {
            DB::beginTransaction();
                $user = new \App\User;
                $user->role = '11';
                $user->is_active = '1';
                $user->name =  $request->name;
                $user->phone= $request->phone;
                $user->username= $request->username==null ? $request->phone : $request->username;
                $user->email= $request->email;
                $user->password = bcrypt($request->password);
                $user->fcm_token = $request->fcm_token;
                $user->remember_token = Str::random(60);
                $user->join_ref_code = $request->join_ref_code;
                $user->ref_code = $code;
                $user->point = $total_point;
                $user->save();


                $member = Customer::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'code' => $code,
                    'name_customer' => $request->name,
                    'phone_customer' => $request->phone,
                    'address_customer' => $request->address,
                    'email_customer' => $request->email,
                    'address'=> $request->address,
                    'category_user' => 1,
                    'is_active' => 1
                ]);


            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            return response()->json([
                'success'=>false,
                'message'=> $e
            ], $this->successStatus);
        }

        return response()->json([
            'success'=>true,
            'message'=> "Registrasi berhasil"
        ], $this->successStatus);
    }

    public function cekRefcode($refcode)
    {
        $ye = User::where('ref_code',$refcode)->get()->count();
        if($ye > 0){
            $p = Point::where('code','RC01')->first()->point;
            return $p;
        }
        return 0;
    }
    public function generateCode()
    {
        $code = Str::random(5);
        return $code;
    }

}
