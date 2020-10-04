<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";
    protected $fillable = ["code","date","due_date","total_bill","status","customer_id","image","date_payment","total_payment"];

    public function image()
    {
        return $this->image==null ||$this->image=="" ? "" : asset('images/invoice').'/'.$this->id.'/'.$this->image;
    }
}
