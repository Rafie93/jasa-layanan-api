<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'citys';
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
