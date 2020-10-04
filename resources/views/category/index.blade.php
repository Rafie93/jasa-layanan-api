@extends('layouts.app')
@section('breadcrumb')
<li><i class="ace-icon fa fa-home home-icon"></i><a href="/dashboard">Home</a></li>
<li class="active">Category</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Category<small><i class="ace-icon fa fa-angle-double-right"></i> kategori layanan dan sub kategori layanan </small></h1>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-md-5">
            <div class="panel panel-default table-responsive">
                @include('category.partials.parent')
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default table-responsive">
              @include('category.partials.sub')
            </div>
        </div>
    </div>
</div>
@endsection
