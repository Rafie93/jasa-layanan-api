@extends('layouts.app')
@section('title', "Daftar Invoice Tunai")
@section('breadcrumb')
<li><a href="{{Route('invoice.tunai')}}"><i class="ace-icon fa fa-money home-icon"></i>Invoice Tunai</a></li>
    <li>Buat Invoice Tunai {{request('code')}}</li>

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Invoice Tunai Baru</h3></div>
            <div class="panel-body">

            {!! Form::open(['route'=>'invoice.tunai.store']) !!}

            {{ Form::hidden('code', request('code'),array('id'=>'code')) }}
            {{-- @php
                $getAwb = $awbQuery->getAwbByNumber(request('c'));

            @endphp --}}

            {!! FormField::text('date', [
                'label' => "Tanggal Invoice",
                'class' => 'tanggal',
                'value' =>  request('date') ? request('date') : date('Y-m-d'),
                'required' => true,
            ]) !!}

            <label class="form-label">Invoice No.</label>
            {!! Form::text('number', null,array(
                'class' => 'form-control',
                'value' => request('number')
            )) !!}
            <i>Kosongkan jika ingin <strong>No. Invoice</strong> otomatis</i><br><br>

            {!! FormField::text('amount', [
                'label' => "Total",
                'class' => 'text-right',
                'value' =>  request('amount') ? request('amount') : 0,
                'required' => true,
                'readonly' => true
            ]) !!}

            {!! FormField::text('discount', [
                'label' => "Diskon",
                'class' => 'text-right',
                'value' =>  request('discount') ? request('discount') : 0
            ]) !!}

            {!! FormField::text('administrasi_cost', [
                'label' => "Administrasi",
                'class' => 'text-right',
                'value' =>  request('administrasi_cost') ? request('administrasi_cost') : 0
            ]) !!}

            {!! FormField::text('grand_total', [
                'label' => "Grand Total",
                'class' => 'text-right',
                'value' =>  request('grand_total') ? request('grand_total') :  0,
                'readonly' => true
            ]) !!}

            {!! FormField::textarea('notes', [
                'label' => "Catatan Invoice",
                'class' => 'form-control',
                'value' => request('notes')
            ]) !!}

            {!! Form::submit('SUBMIT', [
                'class'=>'btn btn-primary',
                ]) !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection
