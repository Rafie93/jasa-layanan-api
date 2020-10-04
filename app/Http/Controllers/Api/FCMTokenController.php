<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class FCMTokenController extends Controller
{

    public function update(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $fcm_old = $user->fcm_token;
        $fcm_new = $request->fcm_token;

        if( ($fcm_old != $fcm_old) || strlen($fcm_new)==152){
            $user = User::where('id', $userId)
                    ->update([
                        'fcm_token' => $request->fcm_token,
            ]);
            return response()->json([
                'success'=>true,
                'message' => 'Token Sukses Diperbaharui',
                'fcm_token'=>$request->fcm_token
            ], 200);
        }
        return response()->json([
            'success'=>false,
            'message'=> 'Token Tidak Di Perbaharui',
            'data'=>($fcm_old)
        ], 400);

    }
}
