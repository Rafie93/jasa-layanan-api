<div class="panel-heading">
    <h3 class="panel-title">Kategori Layanan</h3>
</div>
<table class="table table-bordered table-hover">
    <thead>
        <th class="text-center">#</th>
        <th class="text-center">Name</th>
        <th class="text-center">Description</th>
        <th class="text-center">Status</th>
        <th class="text-center">Aksi</th>
    </thead>
    <tbody>
        @if ($category->isEmpty())
            <tr><td colspan="5">Tidak Ada Data</td></tr>
        @else
            @foreach ($category as $key=>$cat)
                <tr>
                    <td>{{ 1 + $key }}</td>
                    <td>{{$cat->name}}</td>
                    <td>{{$cat->description}}</td>
                    <td>{{$cat->isAktif()}}</td>
                    <td>
                        <button class="btn-primary"><i class="glyphicon glyphicon-edit"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

</table>
