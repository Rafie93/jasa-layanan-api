<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Resources\User as UserResource;


class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    public $successStatus = 200;

    public function login(Request $request){
        $this->clearLoginAttempts($request);

        if(Auth::attempt(['no_telepon' => request('no_telepon'), 'password' => request('password'),'role'=>2,'is_activated'=>1])){
            $user = Auth::user();
            return new UserResource($user);
        }else if(Auth::attempt(['username' => request('no_telepon'), 'password' => request('password'),'role'=>2,'is_activated'=>1])){
            $user = Auth::user();
            return new UserResource($user);
        }
        else{
            $cekUser = User::where('no_telepon',$request->no_telepon)->get()->count();
            $cekUserName = User::where('username',$request->no_telepon)->get()->count();
            if($cekUser > 0){
                return response()->json(['success'=>false,'message'=>'Password yang anda masukkan Salah'], 400);
            }else if($cekUserName > 0){
                return response()->json(['success'=>false,'message'=>'Password yang anda masukkan Salah'], 400);
            }
            else{
                return response()->json(['success'=>false,'message'=>'No Telepon / no kartu yang anda masukkan tidak terdaftar'], 400);
            }
        }


    }
    public function unauthorised(Request $request)
    {
        return response()->json(['success'=>false,'error'=>'Unauthorised'], 401);
    }
  
}
