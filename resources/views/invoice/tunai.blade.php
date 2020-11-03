@extends('layouts.app')
@section('title', "Daftar Invoice Tunai")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-money home-icon"></i> Invoice Tunai</li>
@endsection

@section('content')
    @include('invoice.partials.header')
    @include('invoice.partials.table-tunai')
@endsection
