<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    protected $table = "product_comment";
    protected $fillable = ["product_id","commentar","image","creator_id","to","type","is_read"];

    public function image()
    {
        return $this->image==null ||$this->image=="" ? null : asset('images/products').'/'.$this->product_id.'/comments/'.$this->image;
    }

}
