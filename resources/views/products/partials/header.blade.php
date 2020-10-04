@inject('categoryQuery', 'App\Models\Products\CategoryQuery')

<form method="get" action="{{ url()->current() }}">
    <div class="row">

        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-2" style="float: left">
                            <a href="{{Route('products.add')}}" class="btn btn-sm btn-info"> <i class="ace-icon fa fa-plus bigger-110"></i>
                                Tambah Produk</a>
                        </div>


                        <div class="form-group col-xs-12 col-sm-7" style="float: right">

                            <select onchange="this.form.submit()" name="filterKategori" id="filterKategori" class="form-control input-sm pull-right" style="width: 250px;">
                                <option value="">--Semua Kategori--</option>

                                {!! options($categoryQuery->getCategory(),'id',request('filterKategori'),'name') !!}

                             </select>

                            <div class="input-group">
                                <input type="text" class="form-control gp-search" name="keyword" placeholder="Cari" value="{{request('keyword')}}" autocomplete="off">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
