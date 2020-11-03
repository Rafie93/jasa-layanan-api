@extends('layouts.app')
@section('title', "Detail Invoice")
@section('breadcrumb')
    <li>Detail Invoice {{request('number')}}</li>

@endsection

@section('content')
    @include('invoice.partials.start-form')
    <div class="clearfix"></div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#detail" data-toggle="tab">List AWB</a></li>
       @if($invoices->payment_method_id==2) <li><a href="#payment" data-toggle="tab">Pembayaran</a></li> @endif


    </ul>
    <div class="tab-content">
        @include('invoice.partials.tab-list-awb')
        @include('invoice.partials.tab-payment')
    </div>
@endsection
