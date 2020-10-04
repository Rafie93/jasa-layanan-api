<?php

namespace App\Http\Controllers\Api\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Customer;
use App\Models\Orders\Order;

class InvoiceController extends Controller
{
    public function getInvoice(Request $request)
    {
        $customer = Customer::where('user_id',auth()->user()->id)->first();
        return response()->json([
            'success' => true,
            'invoices' => Invoice::where('customer_id',$customer->id)
        ],200);
    }

    public function bayar(Request $request)
    {
        $invoiceId = $request->invoice_id;
        try
        {
            DB::beginTransaction();
                $invoice =Invoice::where('id',$invoiceId)->update([
                    'date_payment'=> date('Y-m-d H:i:s'),
                    'status' => 1,
                    'total_payment'=> $request->total
                ]);
                if ($request->hasFile('file')) {
                    $foto = $request->file('file');
                    $fileName = $foto->getClientOriginalName();
                    $request->file('file')->move('images/invoice/'.$invoiceId,$fileName);
                    $fotoUpdate = Invoice::where('id',$invoiceId)
                                ->update(['image' => $fileName]);
                }
                Order::where('invoice_id',$invoiceId)->update([
                    'status_payment' => 1
                ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Pembayaran Berhasil dilakukan"
            ],200);

        }  catch (\PDOException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => "Gagal melakukan pembayaran",
                'error' => $e
            ],400);

        }
    }

    public function getBank(Request $request)
    {
        # code...
    }
}
