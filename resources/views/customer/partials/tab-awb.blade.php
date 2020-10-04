<div class="tab-pane" id="awb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List AWB {{$customer->name}}</h3></div>
                <div class="panel-body">
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
                            <th class="text-center">On Status</th>
                            <th class="text-center">Aksi</th>

                        </thead>
                        <tbody>
                           @if ($awbs->isEmpty()) <tr><td colspan="11">Tidak Ada Data</td></tr>
                           @else
                                @foreach ($awbs as $key=>$awb)
                                    <tr>
                                        <td class="text-center">{{ 1+ $key }}</td>
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
                                        <td class="text-center">{{number_format($awb->amount)}}</td>
                                        <td class="text-center">{!!$awb->isStatusBadge()!!}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{Route('awb.detail',['number' => $awb->number])}}" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></a>
                                            <a  target="__BLANK" href="{{'/awb/print/'.$awb->number}}" class="btn btn-success"><i class="glyphicon glyphicon-print"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                           @endif
                        </tbody>
                    </table>
                    {{$awbs->links()}}

                </div>
            </div>
        </div>


    </div>
</div>
