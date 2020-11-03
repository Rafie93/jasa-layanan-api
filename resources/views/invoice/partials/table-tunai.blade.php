<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">List Invoice Tunai</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">No. Invoice</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kustomer</th>
            <th class="text-center">Grand Total</th>
            <th class="text-center">Aksi</th>

        </thead>
        <tbody>
           @if ($tunai->isEmpty()) <tr><td colspan="11">Tidak Ada Data</td></tr>
           @else
                @foreach ($tunai as $key=>$row)
                    <tr>
                        <td>{{ $tunai->firstItem() + $key }}</td>
                        <td>
                            {{ link_to_route('invoice.detail', $row->code, ['number' => $row->code], ['title' => 'Lihat Invoice'. $row->code]) }}
                        </td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->customer_id==0 ? 'Umum' : $row->customer->name}}</td>
                        <td align="right">{{number_format($row->total_bill)}}</td>
                        <td align="center">
                            <a  target="__BLANK" href="{{'/invoice/print/'.$row->code}}" class="btn btn-default btn-sm">
                                <i class="glyphicon glyphicon-print"></i> Cetak</a>
                        </td>
                    </tr>
                @endforeach
           @endif
        </tbody>
    </table>
</div>
{{$tunai->appends(request()->except('page'))->links()}}
