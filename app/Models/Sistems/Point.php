<?php

namespace App\Models\Sistems;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    //
    protected $table = "point_sistem";
    protected $fillable = ["code","name","point","description","is_active"];

    public function isAktif()
    {
       return $this->is_active==1 ? "Aktif" : "Non Aktif";
    }

}
