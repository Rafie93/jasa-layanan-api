@extends('layouts.app')
@section('title', "Daftar Invoice Cash On Delivery")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-money home-icon"></i> Invoice Cash On Delivery</li>
@endsection

@section('content')
    @include('invoice.partials.header-cod')
    @include('invoice.partials.table-cod')
@endsection
