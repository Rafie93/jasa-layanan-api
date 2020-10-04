<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = "order_detail";
    protected $fillable = ["product_id","product_price_id","price","quantity","quantity_received","keterangan"];

    public function products()
    {
        return $this->belongsTo('App\Models\Products\Product',"product_id");
    }
    public function product_variant()
    {
        return $this->belongsTo('App\Models\Products\ProductPrice',"product_price_id");
    }
}
