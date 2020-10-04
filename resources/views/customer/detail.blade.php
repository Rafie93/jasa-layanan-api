@extends('layouts.app')
@section('title', "Detail Customer")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("customer.index")}}">Customer</a></li>
    <li>{{$customer->name}}</li>

@endsection
@section('content')
<div class="clearfix"></div>
<ul class="nav nav-tabs">
    <li class="active"><a href="#detail" data-toggle="tab">Detail Customer</a></li>
    <li><a href="#tarif" data-toggle="tab">Tarif Khusus</a></li>
    <li><a href="#awb" data-toggle="tab">List AWB</a></li>
    <li><a href="#invoice" data-toggle="tab">List Invoice</a></li>

</ul>
<div class="tab-content">
    @include('customer.partials.tab-detail')
    @include('customer.partials.tab-tarif')
    @include('customer.partials.tab-awb')
    @include('customer.partials.tab-invoice')
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
                      window.location = "/customer/"+id+"/delete";
                  }
                });
            });
        } );

    </script>
@endsection
