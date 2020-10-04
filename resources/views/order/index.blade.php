@inject('orderQuery', 'App\Models\Orders\OrderQuery')

@extends('layouts.app')
@section('title', "Order")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("products.index")}}">Order</a></li>

@endsection
@section('content')
<div class="page-header">
    <h1> Pemesanan produk layanan<small><i class="ace-icon fa fa-angle-double-right"></i> manajemen data pesanan</small></h1>
</div>
<div class="clearfix"></div>
<ul class="nav nav-tabs">
    <li class="active"><a href="#request" data-toggle="tab">Permintaan Pesanan <span class="badge badge-danger">{{count($orderQuery->getOrderRequest())}}</span></a></li>
    <li><a href="#process" data-toggle="tab">Pesanan Sedang Proses <span class="badge badge-info">{{count($orderQuery->getOrderProses())}}</span></a></li>
    <li><a href="#complete" data-toggle="tab">Pesanan Complete <span class="badge badge-success">{{count($orderQuery->getOrderComplete())}}</span></a> </li>
    <li><a href="#cancel" data-toggle="tab">Pesanan Dibatalkan  <span class="badge badge-warning">{{count($orderQuery->getOrderCancel())}}</span></a></a></li>
</ul>
<div class="tab-content">
    @include('order.partials.tab-permintaan')
    @include('order.partials.tab-process')
    @include('order.partials.tab-complete')
    @include('order.partials.tab-cancel')
</div>
@endsection

@section('footer')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
        $().ready( function () {
            $('.myTable').DataTable();
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
                      window.location = "/products/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
