<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductFavorit extends Model
{
    protected $table = "product_favorit";
    protected $fillable = ["product_id"];

}
