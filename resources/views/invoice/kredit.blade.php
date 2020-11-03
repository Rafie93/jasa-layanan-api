@extends('layouts.app')
@section('title', "Daftar Invoice Kredit")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-money home-icon"></i> Invoice Kredit</li>
@endsection

@section('content')
    @include('invoice.partials.header-kredit')
    @include('invoice.partials.table-kredit')
@endsection
