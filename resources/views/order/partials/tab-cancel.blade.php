@inject('orderQuery', 'App\Models\Orders\OrderQuery')

<div class="tab-pane" id="cancel">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Pesanan dibatalkan</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered myTable">
                        <thead>
                           <tr>
                            <th align="center">No</th>
                            <th align="center">Code</th>
                            <th align="center">Tanggal</th>
                            <th align="center">Tanggal Kebutuhan</th>
                            <th align="center">Total Harga</th>
                            <th align="center">Customer</th>
                            <th align="center">Alasan</th>
                            <th align="center">Rincian</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderQuery->getOrderCancel() as $key=>$row)
                                <tr>
                                    <td align="center">{{1+$key}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_order)->format('d M Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_in_use)->format('d M Y')}}</td>
                                    <td align="right">{{number_format($row->price_total)}}</td>
                                    <td>{{$row->customer->name}}</td>
                                    <td></td>
                                    <td align="center"><a href="" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
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
