<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:5',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login = [
            $loginType => $request->username,
            'password' => $request->password,
            'role'     => '99',
            'is_active'=>1
        ];
        if(auth()->attempt($login)){
    		return redirect('/dashboard')->with('sukses','Selamat, Anda berhasil masuk aplikasi');
    	}else{
    		return redirect()->route('login')->with('gagal','mohon masukkan password dengan benar');
    	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
}
