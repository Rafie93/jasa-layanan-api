@inject('orderQuery', 'App\Models\Orders\OrderQuery')

<div class="tab-pane active" id="request">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Permintaan Pesanan, Silahkan dikonfirmasi</h3></div>
                <div class="panel-body">
                    <span class="badge-warning"><i>***Catatan: Maksimal 3 hari setelah permintaan, jika lebih dari 3 hari belum dikonfirmasi sistem otomatis membatalkan pesanan customer</i></span>
                    <br><br>
                    <table class="table table-responsive table-bordered myTable">
                        <thead>
                           <tr>
                            <th align="center">No</th>
                            <th align="center">Code</th>
                            <th align="center">Tanggal</th>
                            <th align="center">Tanggal Kebutuhan</th>
                            <th align="center">Total Harga</th>
                            <th align="center">Customer</th>
                            <th align="center">Status</th>
                            <th align="center">Tindakan</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderQuery->getOrderRequest() as $key=>$row)
                                <tr>
                                    <td align="center">{{1+$key}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_order)->format('d M Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_in_use)->format('d M Y')}}</td>
                                    <td align="right">{{number_format($row->price_total)}}</td>
                                    <td>{{$row->customer->name}}</td>
                                    <td align="center"><span class="badge badge-danger">{{$row->statusOrder()->neopedia}}</span></td>
                                    <td align="center"><a href="{{Route('order.detail',$row->code)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
