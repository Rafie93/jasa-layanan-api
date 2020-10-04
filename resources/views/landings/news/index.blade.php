@extends('layouts.app')
@section('title', "News")
@section('breadcrumb')
    <li>News</li>
@endsection
@section('content')
<div class="page-header">
    <h1> News<small><i class="ace-icon fa fa-angle-double-right"></i>simpan data News guna untuk menampilkan News pada app customer / pengunjung </small></h1>
</div>
@include('landings.news.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data News</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Thumbnail</th>
            <th class="text-center">Title</th>
            <th class="text-center">Kategori</th>
            <th  class="text-center">Status</th>
            <th  class="text-center">Aksi</th>
        </thead>
        <tbody>
           @if ($news->isEmpty())
               <tr><td colspan="6">Tidak ada News ditambahkan</td></tr>
           @else
            @foreach($news as $key => $row)
            <tr>
                <td class="text-center">{{ 1 + $key }}</td>
                <td class="text-center"><img src="{{ $row->thumbnail() }}" height="80px"></td>
                <td class="text-center">{{ $row->title }}</td>
                <td class="text-center">{{ $row->category_news }}</td>
                <td class="text-center">{{ $row->isStatus() }}</td>
                <td>
                    <a href="{{Route('news.detail',$row->slug)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{Route('news.edit',$row->slug)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>

                    <a href="#" class="btn btn-danger delete" r-name="{{ $row->title}}" r-id="{{ $row->id }}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
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
                      window.location = "/landing/news/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
