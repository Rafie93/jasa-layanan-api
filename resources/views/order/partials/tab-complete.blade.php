@inject('orderQuery', 'App\Models\Orders\OrderQuery')

<div class="tab-pane" id="complete">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Permintaan Sudah Selesai</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered myTable">
                        <thead>
                           <tr>
                            <th align="center">No</th>
                            <th align="center">Code</th>
                            <th align="center">Tanggal Kebutuhan</th>
                            <th align="center">Tanggal Deal</th>
                            <th align="center">Tanggal Selesai</th>
                            <th align="center">Harga Awal</th>
                            <th align="center">Harga Deal</th>
                            <th align="center">Customer</th>
                            <th align="center">Rincian</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderQuery->getOrderComplete() as $key=>$row)
                                <tr>
                                    <td align="center">{{1+$key}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_in_use)->format('d M Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_deal)->format('d M Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($row->date_complete)->format('d M Y')}}</td>
                                    <td align="right">{{number_format($row->price_total)}}</td>
                                    <td align="right">{{number_format($row->price_deal)}}</td>
                                    <td>{{$row->customer->name}}</td>
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
