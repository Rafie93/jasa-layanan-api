<?php
namespace App\Models\Invoice;

use App\Models\Invoice\Invoice;
use App\Models\Sistem\NumberSequence;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/**
* Invoice Query Object
*/
class InvoiceQuery
{
    public function getInvoiceTunai()
    {
       $invoice = Invoice::orderBy('id','desc')
                        ->where("payment_method_id",1)
                        ->paginate(10);
        return $invoice;
    }
    public function getInvoiceCod()
    {
       $invoice = Invoice::orderBy('id','desc')
                        ->where("payment_method_id",3)
                        ->paginate(10);
        return $invoice;
    }

    public function getInvoiceSudahBayar($request)
    {
       $invoice = Invoice::orderBy('id','desc')
                        ->whereNotNull("payment_date")
                        ->when($request->start_date, function ($query) use ($request) {
                            $query->whereDate('payment_date', '>=', "{$request->start_date}");
                        })
                        ->when($request->end_date, function ($query) use ($request) {
                                $query->whereDate('payment_date', '<=', "{$request->end_date}");
                        })
                        ->get();
        return $invoice;
    }

    public function getInvoiceBelumBayar($request)
    {
       $invoice = Invoice::orderBy('id','desc')
                        ->whereNull("payment_date")
                        ->when($request->start_date, function ($query) use ($request) {
                            $query->whereDate('created_at', '>=', "{$request->start_date}");
                        })
                        ->when($request->end_date, function ($query) use ($request) {
                                $query->whereDate('created_at', '<=', "{$request->end_date}");
                        })
                        ->get();
        return $invoice;
    }

    public function getInvoiceByNumber($number)
    {
       $invoice = Invoice::where('number',$number)
                        ->first();
        return $invoice;
    }
    public function getInvoiceById($number)
    {
       $invoice = Invoice::where('id',$number)
                        ->first();
        return $invoice;
    }
    public function getAwbByInvoice($invoiceId)
    {
       $awbs = Awb::where('invoice_id',$invoiceId)
                        ->first();
        return $awbs;
    }
    public function getInvoiceKredit()
    {
        $invoice = Invoice::orderBy('id','desc')
                            ->where("payment_method_id",2)
                            ->paginate(10);
        return $invoice;
    }
    public function storeTunai($request)
    {
        $total = ($request->amount - $request->discount) + $request->administrasi_cost;
        $awbId = $this->getAwb($request->number_awb)->id;
        $numberInvoice = $request->number!=null ? $request->number : $this->generateNumber();
        $request->merge([
            'number' => $numberInvoice,
            'creator_id'=>auth()->user()->id,
            'grand_total'=>$total,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>1,
            'payment_date' =>Carbon::now(),
            'verify_date' => Carbon::now(),
            'customer_id' =>  $this->getAwb($request->number_awb)->customer_id
        ]);

        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;
           $awb = Awb::where('id',$awbId)->update([
               'invoice_id' => $invoiceId,
               'customer_invoice_no' =>$numberInvoice
           ]);
        DB::commit();
    }

    public function storeCod($request)
    {
        $total = ($request->amount - $request->discount) + $request->administrasi_cost;
        $awbId = $this->getAwb($request->number_awb)->id;
        $numberInvoice = $request->number!=null ? $request->number : $this->generateNumber();
        $paymentDate = $request->payment_date;
        $request->merge([
            'number' => $numberInvoice,
            'creator_id'=>auth()->user()->id,
            'grand_total'=>$total,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>3,
            'payment_date' => $paymentDate=="" ? null : $paymentDate,
            'customer_id' =>  $this->getAwb($request->number_awb)->customer_id
        ]);

        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;
           $awb = Awb::where('id',$awbId)->update([
               'invoice_id' => $invoiceId,
               'customer_invoice_no' =>$numberInvoice
           ]);
        DB::commit();
    }

    public function storeTunaiCustomer($request)
    {
        $numberInvoice = $request->number!=null ? $request->number : $this->generateNumber();
        $request->merge([
            'number' => $numberInvoice,
            'creator_id'=>auth()->user()->id,
            'grand_total'=>0,
            'amount'=>0,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>1,
            'payment_date' =>Carbon::now(),
            'verify_date' => Carbon::now()
        ]);

        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;

           $awbCek = $request['awbCek'];
           $jumlahCek = count($awbCek);
           $total=0;
           for($i=0;$i<$jumlahCek;$i++){
               $awbId = $awbCek[$i];
               $awbs = Awb::where('id',$awbId)->first();
               $total+=$awbs->amount;
               Awb::where('id',$awbId)->update([
                'invoice_id' => $invoiceId,
                'customer_invoice_no' =>$numberInvoice
               ]);
           }

           $invoice->amount = $total;
           $invoice->grand_total =  ($total - $request->discount) + $request->administrasi_cost;
        $invoice->save();
        DB::commit();

        return $numberInvoice;
    }
    public function storeKredit($request)
    {
        $total = ($request->amount - $request->discount) + $request->administrasi_cost;
        $awbId = $this->getAwb($request->number_awb)->id;
        $numberInvoice =  $request->number!=null ? $request->number : $this->generateNumber();
        $request->merge([
            'number' =>$numberInvoice,
            'creator_id'=>auth()->user()->id,
            'grand_total'=>$total,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>2,
            'customer_id' =>  $this->getAwb($request->number_awb)->customer_id
        ]);

        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;

           $awb = Awb::where('id',$awbId)->update([
               'invoice_id' => $invoiceId,
               'customer_invoice_no' =>$numberInvoice
           ]);
        DB::commit();
    }

    public function storeKreditCustomer($request)
    {
        $numberInvoice =  $request->number!=null ? $request->number : $this->generateNumber();
        $request->merge([
            'number' =>$numberInvoice,
            'creator_id'=>auth()->user()->id,
            'amount'=>0,
            'grand_total'=>0,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>2,
        ]);


        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;

           $awbCek = $request['awbCek'];
           $jumlahCek = count($awbCek);
           $total=0;
           for($i=0;$i<$jumlahCek;$i++){
               $awbId = $awbCek[$i];
               $awbs = Awb::where('id',$awbId)->first();
               $total+=$awbs->amount;
               Awb::where('id',$awbId)->update([
                'invoice_id' => $invoiceId,
                'customer_invoice_no' =>$numberInvoice
               ]);
           }

           $invoice->amount = $total;
            $invoice->grand_total =  ($total - $request->discount) + $request->administrasi_cost;
           $invoice->save();

        DB::commit();

        return $numberInvoice;
    }

    public function storeCodCustomer($request)
    {
        $numberInvoice =  $request->number!=null ? $request->number : $this->generateNumber();
        $request->merge([
            'number' =>$numberInvoice,
            'creator_id'=>auth()->user()->id,
            'amount'=>0,
            'grand_total'=>0,
            'branch_id'=>auth()->user()->branch_id,
            'payment_method_id'=>3,
        ]);


        DB::beginTransaction();
           $invoice = Invoice::create($request->all());
           $invoiceId = $invoice->id;

           $awbCek = $request['awbCek'];
           $jumlahCek = count($awbCek);
           $total=0;
           for($i=0;$i<$jumlahCek;$i++){
               $awbId = $awbCek[$i];
               $awbs = Awb::where('id',$awbId)->first();
               $total+=$awbs->amount;
               Awb::where('id',$awbId)->update([
                'invoice_id' => $invoiceId,
                'customer_invoice_no' =>$numberInvoice
               ]);
           }

           $invoice->amount = $total;
           $invoice->grand_total =  ($total - $request->discount) + $request->administrasi_cost;
           $invoice->save();

        DB::commit();

        return $numberInvoice;
    }

    public function getAwb($number)
    {
        return Awb::where('number',$number)->first();
    }
    public function generateNumber()
    {
        $year = date('Y');
        $sequence =NumberSequence::where('seq_kode',"INV")
                                ->where('seq_year',$year)
                                ->first();

        $number_real = !is_null($sequence) ? $sequence->seq_value+1 : '1';
        $number = $number_real;
        if($number_real<10) $number = "000".$number;
        else if($number_real<100) $number = "00".$number;
        else if($number_real<1000) $number = "0".$number;

        NumberSequence::updateOrInsert([
            'seq_kode'=>'INV',
            'seq_year'=>$year,
        ],[
            'seq_kode'=>'INV',
            'seq_year'=>$year,
            'seq_value'=>$number_real
        ]);

        return "INV".date('y').date('m').date('d').$number;
    }

    public function cekPayment($invoiceId)
    {
        return Invoice::where('id',$invoiceId)->first()->payment_date == null;
    }
}
