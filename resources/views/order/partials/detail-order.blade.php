@inject('orderQuery', 'App\Models\Orders\OrderQuery')

<div class="tab-pane active" id="detail">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Data Order</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tr>
                            <td>Order Code</td>
                            <td>{{$order->code}}</td>
                        </tr>
                        <tr>
                            <td>Customer </td>
                            <td>{{$order->customer->name}}</td>
                        </tr>
                        <tr>
                            <td>No Telp / HP </td>
                            <td><strong>{{$order->customer->phone_customer}}<strong></td>
                        </tr>
                        <tr>
                            <td>Tanggal Order</td>
                            <td>{{Carbon\Carbon::parse($order->date_order)->format('d M Y')}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kebutuhan</td>
                            <td>{{Carbon\Carbon::parse($order->date_in_use)->format('d M Y')}}</td>
                        </tr>
                        @if($order->date_deal!=null)
                        <tr >
                            <td>Tanggal Sepakat</td>
                            <td>{{Carbon\Carbon::parse($order->date_deal)->format('d M Y')}}</td>
                        </tr>
                        @endif
                        @if($order->date_proses!=null)
                        <tr>
                            <td>Tanggal Proses</td>
                            <td>{{Carbon\Carbon::parse($order->date_proses)->format('d M Y')}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Total Pesanan </td>
                            <td align="right"><span class="badge badge-info">Rp. {{number_format($order->price_total)}}</span></td>
                        </tr>

                        <tr>
                            <td>Metode Pembayaran </td>
                            <td align="right"><span class="badge badge-success">{{$order->isMethodPayment()}}</span></td>
                        </tr>

                        <tr>
                            <td>Catatan Customer</td>
                            <td>{{$order->notes_customer}}</td>
                        </tr>
                        <tr>
                            <td>Status </td>
                            <td align="right"><span class="badge badge-default">{{$order->statusOrder()->neopedia}}</span></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <br>
                <p> &nbsp;&nbsp; Alamat Pengiriman : {{$order->address_shipping}}</p>
                <div class="panel-heading"><h3 class="panel-title">Item Produk Order</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered">
                      <thead>
                        <tr>
                            <td></td>
                            <td>Produk</td>
                            <td>Varian</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Price Total</td>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orderQuery->getPorductOrder($order->id) as $key=>$variant)
                              <tr>
                                  <td align="center">{{1+$key}}</td>
                                  <td>{{$variant->products->category->name}}<br>{{$variant->products->name}}</td>
                                  <td>@if($variant->product_price_id!=0) {{$variant->product_variant->ukuran.' '.$variant->product_variant->bahan}}
                                    @else Tidak Ada Varian @endif</td>
                                  <td align="center">{{$variant->quantity}}</td>
                                  <td align="right"><span class="badge badge-info">Rp{{number_format($variant->price)}}</span></td>
                                  <td align="right">
                                      <input type="text" style="text-align:right" name="price_deal" value="{{$variant->price}}">
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="row" >

        <div class="form-group col-xs-12 4" style="float: left">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Konfirmasi Order </h3></div>
                     <div class="panel-body">
                         @if ($order->status==1 || $order->status==3)
                            {!! Form::model($order, ['route' => ['order.update', $order->id],'method' => 'post']) !!}
                            <table class="table">

                                <tr>
                                    <td>Status Orders</td>
                                    <td>
                                        <select name="status" required id="status" class="form-control">
                                            <option value="">--Ganti Status Pesanan --</option>
                                            <option value="3">Pesanan Disepakati</option>
                                            <option value="4">Pesanan Sedang Diproses </option>
                                            <option value="5">Batalkan Pesanan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Sepakat (Termasuk Ongkir dan Lainnya)</td>
                                        <td>
                                            {!! Form::text('price_deal',
                                            $order->price_deal==0 ? $order->price_total : $order->price_deal
                                            ) !!}
                                        </td>
                                </tr>

                                <tr>
                                    <td>Tanggal</td>
                                    <td>{!!
                                    Form::text('date',request('date'),
                                    array('placeholder'=>'',
                                    'class'=>"form-control tanggal"))!!}
                                </td>
                                </tr>

                            </table>
                            {!! Form::submit('PROSES', ['class'=>'btn btn-success']) !!}
                         @elseif($order->status==4)
                            {!! Form::model($order, ['route' => ['order.update', $order->id],'method' => 'post']) !!}
                            <table class="table">
                                <tr>
                                    <td>Status Orders</td>
                                    <td>
                                        <select name="status" required id="status" class="form-control">
                                            <option value="">--Ganti Status Order--</option>
                                            <option value="44">Pesanan Dikirim </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dikirim</td>
                                    <td>{!! Form::text('date',request('date'),
                                    array('placeholder'=>'',
                                    'class'=>"form-control tanggal")) !!}
                                </td>
                                </tr>

                            </table>
                            {!! Form::submit('PROSES', ['class'=>'btn btn-success']) !!}
                         @elseif($order->status==44)
                         {!! Form::model($order, ['route' => ['order.update', $order->id],'method' => 'post']) !!}
                         <table class="table">
                             <tr>
                                 <td>Status Orders</td>
                                 <td>
                                     <select name="status" required id="status" class="form-control">
                                         <option value="">--Ganti Status Order--</option>
                                         <option value="7">Selesaikan Pesanan </option>
                                     </select>
                                 </td>
                             </tr>
                             <tr>
                                 <td>Tanggal Selesai</td>
                                 <td>{!! Form::text('date',request('date'),
                                 array('placeholder'=>'',
                                 'class'=>"form-control tanggal")) !!}
                             </td>
                             </tr>

                         </table>
                         {!! Form::submit('PROSES', ['class'=>'btn btn-success']) !!}
                      @endif


                    </div>

                </div>
            </div>


        </div>

    </div>
</div>
@section('footer')
<script>

</script>
@endsection
