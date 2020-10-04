@extends('layouts.app')
@section('title', "Tambah Bank Account")
@section('breadcrumb')
    <li><a href="{{Route("bank.index")}}">Bank Account</a></li>
    <li>Tambah Bank Account</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Bank Account<small><i class="ace-icon fa fa-angle-double-right"></i>tambahkan data bank account guna untuk keperluan transfer pembayaran </small></h1>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Form Tambah Bank Account</h3></div>
            <div class="panel-body">
                {!! Form::open(['route'=>'bank.store','enctype' => 'multipart/form-data']) !!}

                {!! FormField::text('bank_name', ['label' => 'Nama Bank*', 'required' => true]) !!}
                {!! FormField::file('bank_logo') !!}
                {!! FormField::text('bank_account_name', ['label' => 'Nama Pemilik Account*', 'required' => true]) !!}
                {!! FormField::text('bank_account_no', ['label' => 'Nomor Account Bank*', 'required' => true]) !!}
                {!! FormField::textarea('description', ['label' => 'Deskripsi']) !!}

                {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}

            </div>
        </div>
    </div>
</div>

@endsection
