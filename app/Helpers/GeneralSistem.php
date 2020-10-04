<?php
use Carbon\Carbon;
use App\Models\Sistems\LogActivity;


function logCreate($userId,$note,$menu='')
{
    LogActivity::create([
        'user_id' => $userId,
        'type_log' => 'Create '.$menu,
        'note' => 'Create data '.$note,
        'ip_address' =>$_SERVER['REMOTE_ADDR']
    ]);
}

    function logUpdate($userId,$note,$menu='')
{
    LogActivity::create([
        'user_id' => $userId,
        'type_log' => 'Update '.$menu,
        'note' => 'Update data '.$note,
        'ip_address' =>$_SERVER['REMOTE_ADDR']
    ]);
}

function logDelete($userId,$note,$menu='')
{
    LogActivity::create([
        'user_id' => $userId,
        'type_log' => 'Delete '.$menu,
        'note' => 'Delete data '.$note,
        'ip_address' =>$_SERVER['REMOTE_ADDR']
    ]);
}


?>
