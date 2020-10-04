@extends('layouts.app')
@section('title', "Point")
@section('breadcrumb')
    <li>Point</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Sistem Point<small><i class="ace-icon fa fa-angle-double-right"></i>atur pendapatan point customer </small></h1>
</div>
@include('master.point.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data Point</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Code</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Point</th>
            <th class="text-center">Deskripsi</th>
            <th  class="text-center">Status</th>
            <th  class="text-center">Aksi</th>
        </thead>
        <tbody>
            @foreach($points as $key => $row)
            <tr>
                <td class="text-center">{{ 1 + $key }}</td>
                <td class="text-center">{{ $row->code }}</td>
                <td class="text-center">{{ $row->name }}</td>
                <td class="text-center">{{ $row->point }}</td>
                <td>{{ $row->description }}</td>
                <td class="text-center">{{ $row->isAktif() }}</td>
                <td>
                    <a href="#" class="btn btn-danger delete" r-name="{{ $row->name}}" r-id="{{ $row->id }}">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        <a href="{{Route('point.edit',$row->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
@section('footer')
<script>
        $().ready( function () {
            $(".delete").click(function() {
                 var id = $(this).attr('r-id');
                 var name = $(this).attr('r-name');
                 Swal.fire({
                  title: 'Ingin Menghapus?',
                  text: "Yakin ingin data  : "+name+" ini ?" ,
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, hapus !'
                }).then((result) => {
                  console.log(result);
                  if (result.value) {
                      window.location = "/master/point/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
