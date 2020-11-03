@inject('awbQuery', 'App\Models\Awb\AwbQuery')

@extends('layouts.app')
@section('title', "Daftar Invoice Kredit")
@section('breadcrumb')
<li><a href="{{Route('invoice.kredit')}}"><i class="ace-icon fa fa-money home-icon"></i>Invoice Kredit</a></li>
    <li>Buat Invoice Kredit {{request('number_awb')}}</li>

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Invoice Kredit Baru</h3></div>
            <div class="panel-body">

            {!! Form::open(['route'=>'invoice.kredit.store']) !!}

            {{ Form::hidden('number_awb', request('number_awb'),array('id'=>'number_awb')) }}
            @php
                $getAwb = $awbQuery->getAwbByNumber(request('number_awb'));

            @endphp

            <label class="form-label">Invoice No.</label>
            {!! Form::text('number', null,array(
                'class' => 'form-control',
                'value' => request('number')
            )) !!}
            <i>Kosongkan jika ingin <strong>No. Invoice</strong> otomatis</i><br><br>

            {!! FormField::text('date', [
                'label' => "Tanggal Invoice",
                'class' => 'tanggal',
                'value' =>  request('date') ? request('date') : date('Y-m-d'),
                'required' => true,
            ]) !!}



            {!! FormField::text('due_date', [
                'label' => "Tanggal Jatuh Tempo",
                'class' => 'tanggal',
                'value' =>  request('due_date') ? request('due_date') : \Carbon\Carbon::now()->addDays(14)->format('Y-m-d'),
                'required' => true,
            ]) !!}

            {!! FormField::text('amount', [
                'label' => "Total",
                'class' => 'text-right',
                'value' =>  request('amount') ? request('amount') : $getAwb->amount,
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
                'value' =>  request('grand_total') ? request('grand_total') :  $getAwb->amount,
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
