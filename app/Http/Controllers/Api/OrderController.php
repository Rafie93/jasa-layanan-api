<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Illuminate\Support\Facades\Auth;
USE App\Member;
use App\Http\Resources\OrderList as OrderResource;
use App\User;
use App\Http\Requests\OrderRequest;
use Hash;
use App\Point;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    //

    public function order(Request $request)
    {
        $user = Auth::user();
        $member_id = Member::where('user_id',$user->id)->first()->id;

        $order = Transaksi::orderBy('id','desc')
                        ->where('member_id',$member_id)
                        ->take(100)
                        ->get();
            
        return response()->json([
            'success'=>true,
            'data'=>new OrderResource($order),
        ], 200);

    }

    public function create(OrderRequest $request)
    {
        $user = Auth::user();
        $member = Member::where('user_id',$user->id)->first();
        $member_id = $member->id;
        $passKasir = $request->password_kasir;
        $pointID = $request->point_id;
        $user_kasir = $request->username;

        $pointSekarang = $member->point;
        $level = $member->level;

        $kasir = User::where('role','3')
                ->where('is_activated','1')
                ->where('username', $user_kasir)
                ->get();

  
        if ($kasir->count()>0){
            $hashedPassword = $kasir->first()->password;
            if(Hash::check($passKasir, $hashedPassword)){
                try {
                    $points = Point::where('id',$pointID)->get()->first();
                    $pointSelected = $points->point;
                    $pointTingkat = $points->tingkat;
                    if ( substr($pointSelected, 0, 1) == '-' ) {
                         $pisahPMin = explode("-",$pointSelected);
                         $hasilPoint = $pointSekarang - $pisahPMin[1];
                        //  if($hasilPoint < 0){
                        //     return response()->json([
                        //         'success'=>false,
                        //         'error' => "Poin Tidak Cukup Untuk Ditukarkan"
                        //     ], 200);
                        //  }
                    } else {
                        $hasilPoint = $pointSekarang + $pointSelected;
                    }
                    if($pointTingkat!='-'){
                        $level = $pointTingkat;
                    }
                    DB::beginTransaction();
                        $order = Transaksi::create([
                            'point_id'=> $pointID,
                            'member_id'=>$member_id,
                            'user_id' => $kasir->first()->id,
                            'point_updated' => $hasilPoint
                        ]);

                        $current = Carbon::now()->format('Y-m-d');
                        $lamaJadwal = konfigurasi()->lama_jadwal_potong;
                        $nextPotong =Carbon::now()->addDays($lamaJadwal)->format('Y-m-d');

                        $member->update([
                            'point'=>$hasilPoint,
                            'last_potong'=>$current,
                            'next_potong'=>$nextPotong,
                            'level' => $level
                             ]);
                    DB::commit();
                } catch (\PDOException $e) {
                    DB::rollBack();
                }
    
                return response()->json([
                    'success'=>true,
                    'message'=>'Transaksi Sukses',
                    'point_sekarang' => $hasilPoint,
                    'level' => $level
                ], 200);

            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Password Kasir Salah',
                    
                ], 200);
            }

        }else{
            return response()->json([
                'success'=>false,
                'message'=>'User Kasir Not Found',
            ], 200);
        }
        
    }
}
