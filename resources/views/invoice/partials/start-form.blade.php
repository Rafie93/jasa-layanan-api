<div class="panel panel-default table-responsive hidden-xs">
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">No. Invoce</td>
            <td class="col-xs-2 text-center">Status</td>
            <td class="col-xs-2 text-center">Tanggal</td>
            @if($invoices->payment_method_id==2)
                <td class="col-xs-2 text-center">Jatuh Tempo</td>
            @endif
            <td class="col-xs-2 text-center">Kantor</td>
            <td class="col-xs-2 text-center">Kustomer</td>
            <td class="col-xs-3 text-center">Grand Total</td>
            <td>
                <a target="__BLANK" href="{{'/invoice/print/'.$invoices->number}}" class="btn btn-primary btn-sm w-100" style="width:100%">
                <i class="glyphicon glyphicon-print"></i> Cetak Invoice</a>
            </td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{$invoices->number}}</td>
            <td class="text-center lead" style="border-top: none;">{!!$invoices->isStatusBadge()!!}</td>
            <td class="text-center lead" style="border-top: none;">{{$invoices->date}}</td>
            @if($invoices->payment_method_id==2)
                <td class="text-center lead" style="border-top: none;">{{$invoices->due_date}}</td>
            @endif
            <td class="text-center lead" style="border-top: none;">{{$invoices->branch->name}}</td>

            <td class="text-center lead" style="border-top: none;">{{$invoices->customer_id!=0 ? $invoices->customer->name : 'Umum'}}</td>
            <td class="text-center lead" style="border-top: none;">{{number_format($invoices->amount)}}</td>
            <td>
                @if($invoices->payment_date==null)
                <a  href="{{Route('invoice.kredit.mail',['invoice_number'=>$invoices->number])}}" class="btn btn-success btn-sm w-100" style="width:100%">
                    <i class="glyphicon glyphicon-mail"></i> Kirim Invoice</a>
                @endif
            </td>

            {{-- @if($invoices->invoice_id==null)
                @if($invoices->payment_method_id==1)
                <td><a href="{{Route('invoice.tunai.create',['number_awb'=>$invoices->number])}}" class="btn btn-success btn-sm w-100" style="width:100%"><i class="glyphicon glyphicon-edit"></i> Buat Invoice</a></td>
                @else
                <td><a href="{{Route('invoice.kredit.create',['number_awb'=>$invoices->number])}}" class="btn btn-success btn-sm w-100" style="width:100%"><i class="glyphicon glyphicon-edit"></i> Buat Invoice</a></td>
                @endif
             @else
                @if($invoices->payment_method_id==1)
                <td><a href="{{Route('invoice.tunai.lihat',['number_awb'=>$invoices->number])}}" class="btn btn-success btn-sm w-100" style="width:100%"><i class="glyphicon glyphicon-edit"></i> Lihat Invoice</a></td>
                @else
                <td><a href="{{Route('invoice.kredit.lihat',['number_awb'=>$invoices->number])}}" class="btn btn-success btn-sm w-100" style="width:100%"><i class="glyphicon glyphicon-edit"></i> Lihat Invoice</a></td>
             @endif
            @endif --}}
        </tr>
    </table>
</div>
