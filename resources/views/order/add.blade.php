@extends('layouts.app')
@section('title', "Order")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("products.index")}}">Order</a></li>
    <li>Tambah Order</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Pemesanan produk layanan<small><i class="ace-icon fa fa-angle-double-right"></i> Tambah Pesanan Baru</small></h1>
</div>
<div class="clearfix"></div>
<div class="row">

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! FormField::text('code', [
                    'label' => "Order ID",
                    'class' => 'text-left',
                    'value' =>  request('code') ,
                ]) !!}

                {!! FormField::text('date_order', [
                    'label' => "Tanggal Order",
                    'class' => 'text-left tanggal',
                ]) !!}

                {!! FormField::text('date_deal', [
                    'label' => "Tanggal Sepakat",
                    'class' => 'text-left tanggal',
                ]) !!}

                {!! FormField::text('date_deal', [
                    'label' => "Tanggal Sepakat",
                    'class' => 'text-left tanggal',
                ]) !!}


            </div>
        </div>
    </div>
    <div class="col-md-7">


        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-add-price" data-toggle="tab">Variant</a></li>
            <li><a href="#tab-add-image" data-toggle="tab">Image</a></li>

        </ul>
        <div class="tab-content">


        </div>
    </div>

</div>
<div class="panel-footer">
    {!! Form::submit('SUBMIT', [
        'class'=>'btn btn-success',
        ]) !!}
</div>
{!! Form::close() !!}

@endsection
