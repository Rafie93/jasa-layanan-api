<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = "product_price";
    protected $fillable = ["product_id","bahan","ukuran","pieces_price","price_modal","price"];

}
