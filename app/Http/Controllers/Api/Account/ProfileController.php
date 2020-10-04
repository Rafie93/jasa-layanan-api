<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Resources\User as UserResource;


class ProfileController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request,[
            'password_old'=>'required',
            'password_new'=>'required|min:5',
            'password_confirmation' => 'required_with:password|same:password_new|min:5'
        ]);

        $hashedPassword = $user->password;
        if(Hash::check($request->password_old, $hashedPassword)){
            $user->update([
                'password'=>bcrypt($request->password_new)
            ]);
            return response()->json([
                'success'=>true,
                'message'=>"Password Anda Sudah Diperbaharui",
                'data'=>new UserResource($user)
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=> "Password Lama Salah"
            ], 200);
        }

    }
}
