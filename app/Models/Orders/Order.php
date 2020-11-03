<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\RefOrder;

class Order extends Model
{
    //
    protected $table="order";
    protected $fillable = ["code","date_order","customer_id","date_order","date_in_use","date_complete","date_deal","price_total","price_deal",
    "payment_method","notes_customer","notes_neopedia","invoice_id","status","creator_id","latitude","longitude","address_shipping"
    ,"vendor_id","status_payment","potongan","sub_total","is_deal","date_proses","date_send"];

    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer\Customer','customer_id');
    }

    public function statusOrder()
    {
       return RefOrder::where('group','order')->where('value',$this->status)->first();
    }
    public function statusPayment()
    {
       return RefOrder::where('group','payment')->where('value',$this->status_payment)->first();
    }
    public function isMethodPayment()
    {
        $paymentMethodId = $this->payment_method;
        if($paymentMethodId==1){
            return "Tunai";
        }else if($paymentMethodId==2){
            return "Kredit";
        }else if ($paymentMethodId==3){
            return "Cash On Delivery";
        }
    }

}
