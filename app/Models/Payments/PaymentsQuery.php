<?php
namespace App\Models\Payments;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
* Order Query Object
*/
class PaymentsQuery
{
    public function isMethodPayment($paymentMethodId)
    {
        if($paymentMethodId==1){
            return "Tunai";
        }else if($paymentMethodId==2){
            return "Kredit";
        }else if ($paymentMethodId==3){
            return "Cash On Delivery";
        }
    }
}
