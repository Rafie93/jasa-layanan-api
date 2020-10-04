<div class="tab-pane active" id="detail">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Data Produk</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tr>
                            <td>Code</td>
                            <td>{{$product->code}}</td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td>{{$product->name}}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>{{$product->category->name}}</td>
                        </tr>
                        <tr>
                            <td>Merk </td>
                            <td>{{$product->merk}}</td>
                        </tr>
                        <tr>
                            <td>Harga </td>
                            <td align="right">Rp. {{number_format($product->price)}}</td>
                        </tr>

                        <tr>
                            <td>Vendor / Penyedia </td>
                            <td>{{$product->vendor()}}</td>
                        </tr>
                        <tr>
                            <td>Thumbnail</td>
                            <td><img src="{{ $product->thumbnail() }}" height="100px"></td>
                        </tr>
                        <tr>
                            <td colspan="2">{!!$product->description!!}</td>
                        </tr>



                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Status Produk</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tr>
                            <td>Display Harga</td>
                            <td>{{$product->isDisplay()}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{$product->isStatus()}}</td>
                        </tr>
                        <tr>
                            <td>Is Aktif</td>
                            <td>{{$product->isAktif()}}</td>
                        </tr>
                        <tr>
                            <td>Is PPN</td>
                            <td>{{$product->isPPN()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
