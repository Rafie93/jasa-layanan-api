<form method="get" action="{{ url()->current() }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-3" style="float: left">
                            <a href="{{Route("invoice.kredit.add")}}" class="btn btn-sm btn-info"> <i class="ace-icon fa fa-plus bigger-110"></i>
                                Buat Invoice</a>
                        </div>

                        <div class="form-group col-xs-12 col-sm-3" style="float: right">

                            <div class="input-group">
                                <input type="text"
                                        class="form-control tanggal"
                                        name="date"
                                        value="{{request('date')==" " ? request('date') :date('Y-m-d')}}"
                                        >
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
