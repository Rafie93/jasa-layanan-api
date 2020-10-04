<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Info;
class InformasiAutoNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:informasi-auto-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $hariIni = date('Y-m-d');
        $infos = Info::where('expired_info','>',$hariIni)->get();
        foreach ($infos as $info){
            sendTopic($info->judul_info,$info->isi_info);
        }
    }
}
