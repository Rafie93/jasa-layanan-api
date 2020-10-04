<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;
use App\Member;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\InfoList as InfoResource;
use Carbon\Carbon;

class NotifController extends Controller
{
    public function informasi(Request $request)
    {
        $user = Auth::user();
        $dataMember =Member::where('user_id',$user->id)->first(); 
        $member_id = $dataMember->id;

        //ULTAH
        $ultahkah = false;
        $potongRambutkah = false;

        $ucapan = "Anda belum berulang tahun";
        $kalimatPotong = "Anda belum saatnya potong";

        //ULTAH
        $month = date('m');
        $month2 = "-".$month."-";
        $dd = date('d');
        $hariIni = $month2.$dd;
        $kalimatUltah= konfigurasi()->kalimat_ultah;
        if($dataMember->level == "premium"){
            $kalimatUltah = konfigurasi()->kalimat_ultah_premium;
        }
        
        $yourUltah = Member::where('user_id', $user->id)
                    ->where('tanggal_lahir', 'like', "%{$hariIni}%")->get();

        if($yourUltah->count()>0){
            $ultahkah = true;
            $ucapan = "Selamat ulang tahun ".$user->nama." ".$kalimatUltah;
        }

        //JADWAL
        $membersPotong = Member::where('user_id', $user->id)
                        ->where('next_potong', '=',  Carbon::now()->format('Y-m-d'))
                        ->get();
        if($membersPotong->count()>0){
            $potongRambutkah = true;
            $kalimatPotong = "Hai ".$user->nama." ".konfigurasi()->kalimat_jadwal_potong;
        }             

        //INFO
        $info = Info::orderBy('id','desc')
                        ->whereNull('member_id')
                        ->orWhere(function($query) use ($member_id) {
                            $query->where('member_id', '=',$member_id);
                        })
                        ->get();
            
        return response()->json([
            'success'=>true,      
            'ultah'=> array(
                'is_ultah' => $ultahkah,
                'judul' => 'Ulang Tahun',
                'ucapan' => $ucapan
            ),
            'jadwal'=> array(
                'is_jadwal' => $potongRambutkah,
                'pesan' => $kalimatPotong
            ),
            'data'=>new InfoResource($info),
        ], 200);

    }
}
