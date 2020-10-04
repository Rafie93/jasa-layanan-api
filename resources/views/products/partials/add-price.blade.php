<div class="tab-pane active" id="tab-add-price">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <button onclick="addPrice()" class="btn btn-sm btn-info"><i class="ace-icon fa fa-plus bigger-110"></i>Tambah Varian / Harga</button>

                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <td align="center">Ukuran</td>
                                <td align="center">Bahan</td>
                                <td align="center">Satuan</td>
                                <td align="center">Harga Modal</td>
                                <td align="center">Harga Jual </td>
                                <td align="center"> </td>

                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td align="center">
                                  <input type="text" value="" name="ukuran" placeholder="Ukuran : P" style="width: 90px">
                              </td>
                              <td align="center">
                                <input type="text" name="bahan" placeholder="Bahan" style="width: 100px" value="" >
                            </td>
                              <td align="center">

                                <select name="satuan" id="satuan" class="form-control">
                                    <option value="pcs">pcs</option>
                                    <option value="unit">unit</option>
                                    <option value="box">box</option>
                                    <option value="paket">paket</option>

                                </select>

                              </td>
                              <td align="center">
                                <input type="text" name="price_modal" value=""  class="text-right" placeholder="Harga Modal" style="width: 100px">
                              </td>
                              <td align="center">
                                <input type="text" name="price" class="text-right" value="{{$product->price}}"  placeholder="Harga Jual" style="width: 100px">
                              </td>
                              <td align="center">
                              </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
