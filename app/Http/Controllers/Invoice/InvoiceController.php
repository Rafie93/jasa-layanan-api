<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice\InvoiceQuery;
use PDF;
use Illuminate\Support\Facades\Mail;
// use App\Mail\MailInvoice;
use App\Models\Customers\Customer;

class InvoiceController extends Controller
{
    public function __construct(InvoiceQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function tunai(Request $request)
    {
        $tunai = $this->queryObject->getInvoiceTunai();
        return view('invoice.tunai',compact('tunai'));
    }

    public function kredit(Request $request)
    {
        $kredit = $this->queryObject->getInvoiceKredit();
        return view('invoice.kredit',compact('kredit'));
    }

    public function cod(Request $request)
    {
        $cod = $this->queryObject->getInvoiceCod();
        return view('invoice.cod',compact('cod'));
    }

    public function detail(Request $request)
    {
        $invoices = $this->queryObject->getInvoiceByNumber($request->number);
        $awbs = $this->queryObject->getAwbByInvoice($invoices->id);
        return view('invoice.detail',compact('invoices','awbs'));
    }

    public function createTunai(Request $request)
    {
        return view('invoice.form-tunai');
    }
    public function createCod(Request $request)
    {
        return view('invoice.form-cod');
    }

    public function addTunai(Request $request)
    {
        return view('invoice.list-customer-belum-invoice');
    }

    public function addCod(Request $request)
    {
        return view('invoice.list-customer-belum-invoice-cod');
    }


    public function addKredit(Request $request)
    {
        return view('invoice.list-customer-belum-invoice');
    }

    public function createKredit(Request $request)
    {
        return view('invoice.form-kredit');
    }

    public function createKreditCustomer(Request $request)
    {
        return view('invoice.form-kredit-customer');
    }
    public function createTunaiCustomer(Request $request)
    {
        return view('invoice.form-tunai-customer');
    }
    public function createCodCustomer(Request $request)
    {
        return view('invoice.form-cod-customer');
    }

    public function store_tunai(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
        ]);

        $this->queryObject->storeTunai($request);
        return redirect()->route('awb.detail',['number'=>$request->number_awb])->with('sukses','invoice sudah dibuat');
    }

    public function store_cod(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
        ]);

        $this->queryObject->storeCod($request);
        return redirect()->route('awb.detail',['number'=>$request->number_awb])->with('sukses','invoice sudah dibuat');
    }

    public function store_tunai_customer(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
        ]);

        $numberInvoice = $this->queryObject->storeTunaiCustomer($request);
        return redirect()->route('invoice.detail',['number'=>$numberInvoice])->with('sukses','invoice sudah dibuat');
    }
    public function store_kredit(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
            'due_date' =>'required|date',
        ]);

        $this->queryObject->storeKredit($request);
        return redirect()->route('awb.detail',['number'=>$request->number_awb])->with('sukses','invoice sudah dibuat');
    }
    public function store_kredit_customer(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
            'due_date' =>'required|date',
        ]);
        $numberInvoice = $this->queryObject->storeKreditCustomer($request);
        return redirect()->route('invoice.detail',['number'=>$numberInvoice])->with('sukses','invoice sudah dibuat');
    }
    public function store_cod_customer(Request $request)
    {
        $this->validate($request,[
            'number' => 'unique:invoice',
            'date' =>'required|date',
            'due_date' =>'required|date',
        ]);
        $numberInvoice = $this->queryObject->storeCodCustomer($request);
        return redirect()->route('invoice.detail',['number'=>$numberInvoice])->with('sukses','invoice sudah dibuat');
    }

    public function print($number)
    {
        $invoice = $this->queryObject->getInvoiceByNumber($number);
        $pdf = PDF::setOptions(['isRemoteEnabled' => true])
                                ->loadView('invoice.pdf.pdf', compact('invoice'))
                                ->setPaper([0, 0, 595.28, 430.63]);
         return $pdf->stream($number.'.e-invoice.pdf');
    }
    public function sendToEmail(Request $request)
    {
        $number = $request->invoice_number;
        $invoice = $this->queryObject->getInvoiceByNumber($number);
        $customerId = $invoice->customer_id;
        if($customerId!=0){
            $customers = Customer::find($customerId);
              Mail::to($customers->email_customer)->send(new MailInvoice('INVOICE TAGIHAN PT. BANUA ALAM SEMESTA',$customers,$invoice));
              return redirect()->route('invoice.detail',['number'=>$number])->with('sukses','Invoice Sudah Dikirim');

        }
    }
}
