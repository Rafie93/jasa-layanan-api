@inject('awbQuery', 'App\Models\Awb\AwbQuery')

<div class="tab-pane active" id="detail">
    <div class="panel panel-default table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">No. AWB</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Pengirim</th>
                <th class="text-center">Penerima</th>
                <th class="text-center">Tujuan</th>
                <th class="text-center">Layanan</th>
                <th class="text-center">Berat</th>
                <th class="text-center">Total</th>

            </thead>
            <tbody>
                @php
                    $awbs = $awbQuery->getAwbByInvoiceByNumber(request('number'));
                @endphp
                   @foreach ($awbs as $key=>$awb)
                   <tr>
                       <td class="text-center">{{ 1 + $key }}</td>
                       <td class="text-center">
                        {{ link_to_route('awb.detail', $awb->number, ['number' => $awb->number], ['title' => 'Lihat No AWB'. $awb->number]) }}

                       </td>
                       <td>{{$awb->created_at}}</td>
                       <td>
                           @if($awb->customer_id != 0) {{$awb->customer->name}}<br> @endif
                           {{$awb->getConsignor()['name']}}
                       </td>
                       <td>{{$awb->getConsignee()['name'].' |'.$awb->getConsignee()['phone']}}</td>
                       <td>{{$awb->destCity->name}}</td>
                       <td class="text-center">{{$awb->service->name}}</td>
                       <td class="text-center">{{$awb->weight}}</td>
                       <td align="right">{{number_format($awb->amount)}}</td>

                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>

</div>
