<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendors\Vendor;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = ["code","category_id","name","description","merk","price","is_active","thumbnail","image","is_ppn",'status',"vendor_id"];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function isAktif()
    {
       return $this->is_active==1 ? "Aktif" : "Non Aktif";
    }
    public function isStatus()
    {
       return $this->is_status==1 ? "Publish" : "Draft";
    }
    public function isPPN()
    {
       return $this->is_ppn==1 ? "YA" : "Tidak Ada";
    }
    public function isDisplay()
    {
       return $this->is_ppn==1 ? "YA" : "Tidak";
    }

    public function vendor()
    {
        if($this->vendor_id != null){
           return Vendor::where('id',$this->vendor_id)->first()->name;
        }else{
            return "Tidak ada";
        }
    }

    public function thumbnail()
    {
        return $this->thumbnail==null ||$this->thumbnail=="" ? asset('images/image-not-available.png') : asset('images/products').'/'.$this->id.'/'.$this->thumbnail;
    }
}
