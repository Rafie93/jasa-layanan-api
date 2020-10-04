<form method="get" action="{{ url()->current() }}">
    <div class="row">

        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                            <a href="{{Route("vendor.add")}}" class="btn btn-sm btn-info"> <i class="ace-icon fa fa-plus bigger-110"></i>
                                Tambah</a>
                        </div>

                        <div class="form-group col-xs-12 col-sm-7" style="float: right">

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
