<?php

namespace App\Http\Controllers\Api\Invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments\Bank;

class BankController extends Controller
{
    public function getBank(Request $request)
    {
        $bank = Bank::orderBy('id','desc')->where('is_active',1)->first();
        return response()->json(
            $bank
        ,200);

    }
}
