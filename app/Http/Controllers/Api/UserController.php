<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Member;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public $successStatus = 200;
    public function changeProfile(Request $request)
    {
        $dataUser = Auth::user();
        $userId = $dataUser->id;

        $profileData = $request->validate([
            'nama'  => 'sometimes|required|max:60',
            'email' => 'email|max:255|unique:users,email,'.$userId,
            'no_telepon' => 'required|max:20',
            'tanggal_lahir' => 'required|date',
            'file'  => 'file|max:3000'
        ]);

        $user = User::where('id', $userId)
                ->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_telepon' => $request->no_telepon,
                ]);

        if ($request->hasFile('file')) {
            $foto = $request->file('file');
            $fileName = $foto->getClientOriginalName();
            $request->file('file')->move('images/user/'.$userId,$fileName);
            $fotoUpdate = User::where('id',$userId)
                        ->update(['foto' => $fileName]);
       }

       $member = Member::where('user_id', $userId)
       ->update([
           'nama' => $request->nama,
           'no_telepon' => $request->no_telepon,
           'tempat_lahir' => $request->tempat_lahir,
           'tanggal_lahir' => $request->tanggal_lahir,
           'alamat' => $request->alamat
       ]);

        return response()->json([
            'success'=>true,
            'message'=> __('validation.change'),
            'data' => new UserResource(User::find($userId))
        ], $this->successStatus);

    }
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
