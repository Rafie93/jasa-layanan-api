<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Member;
use App\User;
use Carbon\Carbon;
use App\NotifHistory;

class JadwalPotongAutoNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:jadwal-potong-auto-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'member jadwal potong auto notification';

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
                $pesan = " Hai ".$potong->nama." ".$kalimatJadwalPotong;
                sendMessageToDevice("Jadwal Potong",$pesan,
                                $dataUsers->first()->fcm_token);  
               
                                NotifHistory::insert([
                                    'category'=>'Jadwal Potong',
                                    'pesan' => $pesan,
                                    'user_id' => $userId,
                                    'created_at' => Carbon::now()
                                ]) ;   
                                 
            }
        } 
    }
}
