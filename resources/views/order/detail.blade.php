@extends('layouts.app')
@section('title', "Detail Order")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("order.order")}}">Order</a></li>
    <li>{{$order->code}}</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Detail Order<small><i class="ace-icon fa fa-angle-double-right"></i> detail Order {{$order->code}}</small></h1>
</div>
<div class="clearfix"></div>
<ul class="nav nav-tabs">
    <li class="active"><a href="#detail" data-toggle="tab">Detail Order</a></li>
    {{-- <li><a href="#pengiriman" data-toggle="tab">Alamat Pengiriman</a></li> --}}

</ul>
<div class="tab-content">
    @include('order.partials.detail-order')
</div>
@endsection
