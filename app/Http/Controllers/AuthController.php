<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Mail\ForgotMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }
    public function postlogin(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'),'role'=>1,'is_activated'=>1])){
    	// if (Auth::attempt($request->only('email','password'))) {
    		return redirect('/dashboard')->with('sukses','Selamat, Anda berhasil masuk aplikasi');
    	}else{
    		return redirect('/')->with('gagal','mohon masukkan password dengan benar');
    	}
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }
    public function forgot()
    {
    	return view('forgot');
    }
   
    public function postforgot(Request $request)
    {
        $inputemail = $request->email;
        $user = User::where("email",$inputemail)->get();
    	if ($user->count() > 0) {
            $dt_user = $user->first();
            Mail::to($inputemail)->send(new ForgotMail($dt_user));
    		return redirect('/login')->with('sukses','Cek email anda untuk konfirmasi');
    	}else{
    		return redirect('/forgot')->with('gagal','mohon masukkan email anda dengan benar');
    	}
    }

    public function password_baru($ency)
    {
        $id = Crypt::decryptString($ency);
        $user = User::find($id);
        // dd($user);
        return view('newpassword',['user'=>$user,'id'=>$ency]);
    }
    public function updatepassword(Request $request, $ency)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'password_konfirm' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('/forgot/'.$ency.'/reset')->with('gagal','Cek password baru anda');         
        }

        $id = Crypt::decryptString($ency);
        $password = bcrypt($request->password);
        User::where('id', $id)->update(['password' => $password,'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        return redirect('/login')->with('sukses','Selamat, password anda sudah diperbaharui');
    }
}
