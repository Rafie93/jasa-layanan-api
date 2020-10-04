<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Member;
use Carbon\Carbon;
use App\NotifHistory;

class UlangTahunAutoNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:ulang-tahun-auto-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'member ulang tahun auto notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $month = date('m');
        $month2 = "-".$month."-";
        $dd = date('d');
        $hariIni = $month2.$dd;
        $kalimatUltah= konfigurasi()->kalimat_ultah;
        $dataMembers = Member::where('tanggal_lahir', 'like', "%{$hariIni}%")->get();


        foreach ($dataMembers as $member){
            $userId = $member->user_id;
            $level =$member->level;
            if($level=="premium"){
                $kalimatUltah=konfigurasi()->kalimat_ultah_premium;
            }
  
            $dataUsers = User::where('id', $userId)
                    ->where('is_activated',1)
                    ->whereNotNull('fcm_token')
                    ->get();

            if ($dataUsers->count() > 0){
                 $ultahKe = date('Y') - Carbon::parse($member->tanggal_lahir)->format('Y');
                 $pesan = "Selamat Ulang Tahun yang ke ".$ultahKe.", ".$member->nama." ".$kalimatUltah;    
                
                sendMessageToDevice("Ulang Tahun",$pesan, $dataUsers->first()->fcm_token);    
                NotifHistory::insert([
                    'category'=>'Ulang Tahun',
                    'pesan' => $pesan,
                    'user_id' => $userId,
                    'created_at' => Carbon::now()
                ]) ; 
            }
        } 

        //Looping Jadwal Potong
        $membersPotong = Member::where('next_potong', '=',  Carbon::now()->format('Y-m-d'))
                                ->get();

        foreach ($membersPotong as $potong){
            $userId = $potong->user_id;
            $dataUsers = User::where('id', $userId)
                    ->where('is_activated',1)
                    ->whereNotNull('fcm_token')
                    ->get();
                    
            if ($dataUsers->count() > 0){
                $kalimatJadwalPotong = konfigurasi()->kalimat_jadwal_potong;
                $pesanPotong = " Hai ".$potong->nama." ".$kalimatJadwalPotong;
                sendMessageToDevice("Jadwal Potong",$pesanPotong,
                                $dataUsers->first()->fcm_token);  
            
                NotifHistory::insert([
                    'category'=>'Jadwal Potong',
                    'pesan' => $pesanPotong,
                    'user_id' => $userId,
                    'created_at' => Carbon::now()
                ]) ;   
                                
            }
        } 
    }
}


