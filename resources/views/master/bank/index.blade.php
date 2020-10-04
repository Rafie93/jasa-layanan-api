@extends('layouts.app')
@section('title', "Bank Account")
@section('breadcrumb')
    <li>Bank Account</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Bank Account<small><i class="ace-icon fa fa-angle-double-right"></i>simpan data bank account guna untuk keperluan transfer pembayaran </small></h1>
</div>
@include('master.bank.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data Bank Account</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Logo</th>
            <th class="text-center">Bank</th>
            <th class="text-center">Nama Pemilik Akun</th>
            <th class="text-center">Nomor Akun</th>
            <th class="text-center">Deskripsi</th>
            <th  class="text-center">Status</th>
            <th  class="text-center">Aksi</th>
        </thead>
        <tbody>
            @foreach($banks as $key => $row)
            <tr>
                <td class="text-center">{{ 1 + $key }}</td>
                <td class="text-center"><img src="{{ $row->logo() }}" width="50px" height="50px"></td>
                <td class="text-center">{{ $row->bank_name }}</td>
                <td class="text-center">{{ $row->bank_account_name }}</td>
                <td class="text-center">{{ $row->bank_account_no }}</td>
                <td>{{ $row->description }}</td>
                <td class="text-center">{{ $row->isAktif() }}</td>

                    <td>
                        @if($row->isDelete())
                            <a href="#" class="btn btn-danger delete" r-name="{{ $row->bank_name}}" r-id="{{ $row->id }}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        @endif
                         <a href="{{Route('bank.edit',$row->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
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
                      window.location = "/master/bank/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
