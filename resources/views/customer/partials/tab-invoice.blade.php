<div class="tab-pane" id="invoice">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Invoice {{$customer->name}}</h3></div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center">Kantor</th>
                            <th class="text-center">Kustomer</th>
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>

                        </thead>
                        <tbody>
                           @if ($invoices->isEmpty()) <tr><td colspan="11">Tidak Ada Data</td></tr>
                           @else
                                @foreach ($invoices as $key=>$row)
                                <tr>
                                    <td>{{ $invoices->firstItem() + $key }}</td>
                                    <td class="text-center">
                                        {{ link_to_route('invoice.detail', $row->number, ['number' => $row->number], ['title' => 'Lihat Invoice'. $row->number]) }}
                                    </td>
                                    <td>{{$row->date}}</td>
                                    <td>{{$row->due_date}}</td>
                                    <td>{{$row->branch->name}}</td>
                                    <td>{{$row->customer_id==0 ? 'Umum' : $row->customer->name}}</td>
                                    <td align="right">{{number_format($row->grand_total)}}</td>
                                    <td align="center">{!! $row->isStatusBadge() !!}</td>
                                    <td align="center">
                                        @if($row->payment_date == null)
                                        <a href="{{Route('invoice.kredit.bayar',['invoice_number'=>$row->number])}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-money""></i> Bayar</a>

                                        <a href="{{Route('invoice.kredit.mail',['invoice_number'=>$row->number])}}" class="btn btn-info btn-sm">
                                                <i class="fa fa-money""></i> KIRIM INVOICE</a>
                                        @endif
                                        <a  target="__BLANK" href="{{'/invoice/print/'.$row->number}}" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-print"></i> Cetak</a>
                                    </td>
                                </tr>
                                @endforeach
                           @endif
                        </tbody>
                    </table>
                    {{$invoices->links()}}

                </div>
            </div>
        </div>


    </div>
</div>
