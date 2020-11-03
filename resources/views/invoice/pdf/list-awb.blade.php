@inject('awbQuery', 'App\Models\Awb\AwbQuery')

<table class="full-bordered" style="width: 100%">
    <thead>
        <tr>
            <td align="center">#</td>
            <td align="center">TANGGAL</td>
            <td align="center">AWB</td>
            <td align="center">ORIGIN</td>
            <td align="center">DESTINATION ADDRESS</td>
            <td align="center">WEIGHT</td>
            <td align="center">RATE</td>
            <td align="center">TOTAL</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($awbQuery->getAwbByInvoice($invoice->id) as $key=>$awb)
            <tr>
                <td>{{1 + $key}}</td>
                <td>{{$awb->created_at->format('d-m-Y')}}</td>
                <td align="center">{{$awb->number}}</td>
                <td>{{$awb->origCity->name}}</td>
                <td>{{$awb->destCity->name}}</td>
                <td align="center">{{number_format($awb->weight)}} Kg</td>
                <td align="right">Rp. {{number_format($awb->getCost()['base_rate'])}}  </td>
                <td align="right">Rp. {{number_format($awb->amount)}}</td>
            </tr>
        @endforeach
        <tfoot>
            <tr>
                <td colspan="6" rowspan="3"></td>
                <td>SUB TOTAL</td>
                <td align="right">Rp. {{number_format($invoice->amount)}}</td>
            </tr>
            <tr>
                <td>DISKON</td>
                <td align="right">Rp. {{number_format($invoice->discount)}}</td>
            </tr>
            <tr>
                <td>ADMINISTRASI</td>
                <td align="right">Rp. {{number_format($invoice->administrasi_cost)}}</td>
            </tr>
            <tr>
                <td colspan="6"><i>Terbilang : {{ucwords(terbilang($invoice->grand_total))}}</i></td>
                <td>TOTAL TAGIHAN</td>
                <td align="right">Rp. {{number_format($invoice->grand_total)}}</td>
            </tr>
        </tfoot>
    </tbody>
</table>
