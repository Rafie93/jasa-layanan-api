<div class="panel-heading">
    <a href="" class="btn btn-sm btn-info"> <i class="ace-icon fa fa-plus bigger-110"></i>
    Tambah Sub Kategori</a>
</div>
<table class="table table-bordered table-hover">
    <thead>
        <th class="text-center">#</th>
        <th class="text-center">Thumbnail</th>
        <th class="text-center">Parent</th>
        <th class="text-center">Name</th>
        <th class="text-center">Description</th>
        <th class="text-center">Status</th>
        {{-- <th class="text-center">Aksi</th> --}}
    </thead>
    <tbody>
        @if ($subcategory->isEmpty())
        <tr><td colspan="5">Tidak Ada Data</td></tr>
        @else
            @foreach ($subcategory as $key=>$sub)
                <tr>
                    <td align="center">{{1 + $key}}</td>
                    <td align="center"><img src="{{ $sub->image() }}" width="100px" height="50px"></td>
                    <td>{{$sub->parent()->name}}</td>
                    <td>{{$sub->name}}</td>
                    <td>{{$sub->description}}</td>
                    <td>{{$sub->isAktif()}}</td>
                    {{-- <td></td> --}}
                </tr>
            @endforeach
        @endif
    </tbody>

</table>
</div>
