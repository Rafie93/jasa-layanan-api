<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Resources\User as UserResource;


class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password'),'role'=>11,'is_active'=>1])){
            $user = Auth::user();
            return new UserResource($user);
        }else if(Auth::attempt(['email' => request('phone'), 'password' => request('password'),'role'=>11,'is_active'=>1])){
            $user = Auth::user();
            return new UserResource($user);
        }
        else{
            $cekUser = User::where('phone',$request->phone)->get()->count();
            $cekUserName = User::where('email',$request->phone)->get()->count();
            if($cekUser > 0){
                return response()->json(['success'=>false,'message'=>'Password yang anda masukkan Salah'], 400);
            }else if($cekUserName > 0){
                return response()->json(['success'=>false,'message'=>'Password yang anda masukkan Salah'], 400);
            }
            else{
                return response()->json(['success'=>false,'message'=>'No Telepon / Email yang anda masukkan tidak terdaftar'], 400);
            }
        }


    }
    public function unauthorised(Request $request)
    {
        return response()->json(['success'=>false,'error'=>'Unauthorised'], 401);
    }
}
