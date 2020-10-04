<?php

namespace App\Models\Vendors;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendor";
    protected $fillable = ["user_id","name","phone","email","city_id","destrict_id","address","location","pic_name","pic_email","pic_phone","is_active","postal_code"];

    public function isAktif()
    {
       return $this->is_active==1 ? "Aktif" : "Non Aktif";
    }

    public function isCity()
    {
        return $this->belongsTo('App\Models\Regions\City',"city_id");
    }

    public function isDistrict()
    {
        return $this->orig_district_id!=null ? $this->belongsTo('App\Models\Regions\District',"destrict_id") : "";
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }

}
