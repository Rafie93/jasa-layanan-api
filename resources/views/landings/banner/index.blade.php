@extends('layouts.app')
@section('title', "Banner")
@section('breadcrumb')
    <li>Banner</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Banner<small><i class="ace-icon fa fa-angle-double-right"></i>simpan data Banner guna untuk menampilkan banner pada app customer / pengunjung </small></h1>
</div>
@include('landings.banner.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data Banner</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Image Banner</th>
            <th class="text-center">Title</th>
            <th class="text-center">Deskripsi</th>
            <th  class="text-center">Status</th>
            <th  class="text-center">Aksi</th>
        </thead>
        <tbody>
           @if ($banners->isEmpty())
               <tr><td colspan="6">Tidak ada banner ditambahkan</td></tr>
           @else
            @foreach($banners as $key => $row)
            <tr>
                <td class="text-center">{{ 1 + $key }}</td>
                <td class="text-center"><img src="{{ $row->image() }}" height="80px"></td>
                <td class="text-center">{{ $row->title }}</td>
                <td>{!! $row->description !!}</td>
                <td class="text-center">{{ $row->isAktif() }}</td>
                <td>
                    <a href="#" class="btn btn-danger delete" r-name="{{ $row->title}}" r-id="{{ $row->id }}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                    <a href="{{Route('banner.edit',$row->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                </td>

            </tr>
            @endforeach
           @endif
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
                      window.location = "/landing/banner/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
