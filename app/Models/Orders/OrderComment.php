<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    protected $table = "order_comment";
    protected $fillable = ["order_id","creator_id","pesan","pesan_by","is_read","to"];
}
