@extends('layouts.app')
@section('title', "Daftar Vendor")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> Vendor</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Vendor<small><i class="ace-icon fa fa-angle-double-right"></i>data vendor / partner penyedia jasa atau produk </small></h1>
</div>
@include('vendor.partials.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data Vendor</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Email</th>
            <th class="text-center">Kota / Kecamatan</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">PIC</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @if ($vendors->isEmpty())
                <tr>
                    <td colspan="9">Tidak ada data</td>
                </tr>
            @else
                @foreach($vendors as $key => $vendor)
                <tr>
                    <td class="text-center">{{ $vendors->firstItem() + $key }}</td>
                    <td >{{$vendor->name}}</td>
                    <td >{{$vendor->phone }}</td>
                    <td >{{$vendor->email }}</td>
                    <td> {{$vendor->isCity->name}}<br>
                        @if($vendor->orig_district_id!=null){{$vendor->isDistrict->name}} @endif
                    </td>
                    <td>{{$vendor->address}}</td>
                    <td class="text-center">{{$vendor->pic_name}}<br>{{$vendor->pic_phone}}</td>
                    <td class="text-center">{{ $vendor->isAktif() }}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-danger delete" r-name="{{ $vendor->name}}" r-id="{{ $vendor->id }}">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        <a href="{{Route('vendor.edit',$vendor->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{$vendors->appends(request()->except('page'))->links()}}
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
                      window.location = "/vendor/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
