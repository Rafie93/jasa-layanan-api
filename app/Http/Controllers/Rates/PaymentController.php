<?php

namespace App\Http\Controllers\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rates\PaymentQuery;
use App\Models\PaymentMethods\Bank;
class PaymentController extends Controller
{
    public function __construct(PaymentQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function add(Request $request)
    {
        $invoices = $this->queryObject->getInvoiceByNumber($request->invoice_number);
        $bank = Bank::where('is_active',1)->get();
        return view('accounting.transaction.add',compact('invoices','bank'));
    }

    public function addCod(Request $request)
    {
        $invoices = $this->queryObject->getInvoiceByNumber($request->invoice_number);
        $bank = Bank::where('is_active',1)->get();
        return view('accounting.transaction.add-cod',compact('invoices','bank'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'date' =>'required|date',
        ]);

        $invoices = $this->queryObject->store($request);
        return redirect()->route('invoice.kredit');
    }

    public function storeCod(Request $request)
    {
        $this->validate($request,[
            'date' =>'required|date',
        ]);

        $invoices = $this->queryObject->storeCod($request);
        return redirect()->route('invoice.cod');
    }
}
