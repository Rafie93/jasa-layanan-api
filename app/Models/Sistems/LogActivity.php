<?php

namespace App\Models\Sistems;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = "log_activity";
    protected $fillable = ["user_id","type_log","note","ip_address"];
}
