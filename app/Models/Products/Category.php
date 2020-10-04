<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    protected $table = "category";
    protected $fillable = ["parent_id","name","description","is_active","image"];

    public function image()
    {
        return $this->image==""||$this->image==null ? asset('images/image-not-available.png') :  asset('images/category').'/'.$this->id.'/'.$this->image ;
    }

    public function parent()
    {
        return Category::where('id',$this->parent_id)->first();
    }

    public function isAktif()
    {
       return $this->is_active==1 ? "Aktif" : "Non Aktif";
    }
}
