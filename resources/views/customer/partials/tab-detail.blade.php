<div class="tab-pane active" id="detail">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Data Customer</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tr>
                            <td>Nama </td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>{{$customer->isCategory()}}</td>
                        </tr>
                        <tr>
                            <td>Code / Account</td>
                            <td>{{$customer->code.'|'.$customer->account_no}}</td>
                        </tr>
                        <tr>
                            <td>Kantor Cabang</td>
                            <td>{{$customer->branch->name}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai </td>
                            <td>{{$customer->start_date}}</td>
                        </tr>
                        <tr>
                            <td>NPWP </td>
                            <td>{{$customer->npwp}}</td>
                        </tr>
                        <tr>
                            <td>Kota </td>
                            <td>{{$customer->isCity->name}}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan </td>
                            <td>{{$customer->orig_district_id!=null ? $customer->isDistrict->name:'-'}}</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td>{{$customer->address}}</td>
                        </tr>
                        <tr>
                            <td>Kodepos </td>
                            <td>{{$customer->postal_code}}</td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">PIC Customer</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tr>
                            <td>Nama </td>
                            <td>{{$customer->name_customer}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$customer->phone_customer}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$customer->email_customer}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                @if(cekAction("13"))
                                    <a href="{{Route('customer.edit',$customer->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                    @if($customer->isDelete())
                                        <a href="#" class="btn btn-danger delete" r-name="{{ $customer->name}}" r-id="{{ $customer->id }}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
