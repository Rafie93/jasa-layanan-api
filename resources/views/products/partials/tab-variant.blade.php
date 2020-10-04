@inject('productQuery', 'App\Models\Products\ProductQuery')

<div class="tab-pane" id="variant">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Varian Produk {{$product->name}}</h3></div>
                <div class="panel-body">
                    <button class="btn btn-sm btn-info"><i class="ace-icon fa fa-plus bigger-110"></i>Tambah Varian / Harga</button>

                    <table class="table table-responsive table-bordered">
                        <thead>
                           <tr>
                            <th align="center">No</th>
                            <th align="center">Ukuran</th>
                            <th align="center">Bahan</th>
                            <th align="center">Harga Modal</th>
                            <th align="center">Harga Jual</th>
                            <th align="center">Satuan</th>
                            <th align="center">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                            @php
                                $variants = $productQuery->getProductVariant($product->id);
                            @endphp
                            @if ($variants->isEmpty())
                                <tr><td colspan="6">Tidak Ada Data</td></tr>
                            @else
                                @foreach ($variants as $key=>$varian)
                                    <tr>
                                        <td>{{1 + $key}}</td>
                                        <td>{{$varian->ukuran}}</td>
                                        <td>{{$varian->bahan}}</td>
                                        <td align="right">{{number_format($varian->price_modal)}}</td>
                                        <td align="right">{{number_format($varian->price)}}</td>
                                        <td>{{$varian->pieces_price}}</td>
                                        <td align="center">
                                            <a href="{{Route('products.edit',$product->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="{{Route('products.edit',$product->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
