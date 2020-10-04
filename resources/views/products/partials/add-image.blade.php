<div class="tab-pane" id="tab-add-image">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="" class="btn btn-sm btn-info"> <i class="ace-icon fa fa-plus bigger-110"></i>
                        Tambah Image</a>
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <td align="center">Image</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td align="center">
                                  {!! Form::file('image1') !!}
                              </td>
                              <td align="center">
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                              </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
