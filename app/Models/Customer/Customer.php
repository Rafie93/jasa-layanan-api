<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    protected $fillable = ["name","nik","code","npwp",'user_id',
                            "name_customer","phone_customer","email_customer","address","address_customer","orig_city_id",
                            "orig_district_id","postal_code","start_date","category_user","is_active"];

    public function isDelete()
    {
        return TRUE;
    }

    public function isAktif()
    {
       return $this->is_active==1 ? "Aktif" : "Non Aktif";
    }

    public function isCategory()
    {
       return $this->category_user==1 ? "Perusahaan" : "Personal";
    }

    public function isCity()
    {
        return $this->belongsTo('App\Models\Regions\City',"orig_city_id");
    }

    public function isDistrict()
    {
        return $this->orig_district_id!=null ? $this->belongsTo('App\Models\Regions\District',"orig_district_id") : "";
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
