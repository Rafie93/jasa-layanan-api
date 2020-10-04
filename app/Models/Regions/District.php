<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getNameAttribute($name)
    {
        return 'Kec. ' . $name;
    }
}
