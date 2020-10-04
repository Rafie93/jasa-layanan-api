<form method="get" action="{{ url()->current() }}">
    <div class="row">

        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5" style="float: left">
                            <div class="page-header">
                                <h1> Customer<small><i class="ace-icon fa fa-angle-double-right"></i>Data Customer (General, Perusahaan, Reseller) </small></h1>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-7" style="float: right">

                             <select onchange="this.form.submit()" name="filterKategori" id="filterKategori" class="form-control input-sm pull-right" style="width: 250px;">
                                <option value="">--Semua Kategori--</option>
                                <option value="1" @if(request('filterKategori')==1){{'selected'}} @endif>General</option>
                                <option value="2" @if(request('filterKategori')==2){{'selected'}} @endif>Perusahaan</option>
                                <option value="3" @if(request('filterKategori')==2){{'selected'}} @endif>Reseller</option>

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
