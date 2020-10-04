@extends('layouts.app')
@section('title', "Detail Product")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("products.index")}}">Produk</a></li>
    <li>{{$product->name}}</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Detail Produk<small><i class="ace-icon fa fa-angle-double-right"></i> detail produk {{$product->name}}</small></h1>
</div>
<div class="clearfix"></div>
<ul class="nav nav-tabs">
    <li class="active"><a href="#detail" data-toggle="tab">Detail Produk</a></li>
    <li><a href="#variant" data-toggle="tab">Varian Produk</a></li>
    <li><a href="#comment" data-toggle="tab">Komentar Produk <span class="badge badge-danger">2</span></a> </li>
    <li><a href="#order" data-toggle="tab">Request/Order Produk</a></li>
    <li><a href="#chart" data-toggle="tab">Chart</a></li>

</ul>
<div class="tab-content">
    @include('products.partials.tab-detail')
    @include('products.partials.tab-variant')
    @include('products.partials.tab-comment')
    @include('products.partials.tab-order')
    @include('products.partials.tab-chart')
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
                      window.location = "/products/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
