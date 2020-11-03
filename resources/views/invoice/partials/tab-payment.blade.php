<div class="tab-pane" id="payment">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Pembayaran</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <td>Number Transaction</td>
                                <td>Tanggal</td>
                                <td>Jatuh Tempo</td>
                                <td>Total </td>
                                <td>Pembayaran Melalui</td>
                                <td>Catatan</td>
                                <td>Bukti Pembayaran</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices->payment as $pay)
                                <tr>
                                    <td>{{$pay->number}}</td>
                                    <td>{{$pay->date}}</td>
                                    <td align="center">{{$pay->past_due==1 ? 'YA' : 'TIDAK'}}</td>
                                    <td align="right">{{number_format($pay->amount)}}</td>
                                    <td>{{$pay->payment_via.' -'}}
                                        {{$pay->bank_account_id!=null ? $pay->bank->bank_name.' '.$pay->bank->bank_account_name : '' }}</td>
                                    <td>{{$pay->notes}}</td>
                                    <td><a href="{{$pay->proof_payment()}}" target="__blank" rel="">
                                        {{$pay->proof_payment}}
                                    </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
