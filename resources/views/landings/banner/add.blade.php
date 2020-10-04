@extends('layouts.app')
@section('title', "Tambah Banner")
@section('breadcrumb')
    <li><a href="{{Route("banner.index")}}">Banner</a></li>
    <li>Tambah Banner</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Banner<small><i class="ace-icon fa fa-angle-double-right"></i>tambahkan data Banner guna untuk menampilkan banner pada app customer / pengunjung </small></h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Form Tambah Banner</h3></div>
            <div class="panel-body">
                {!! Form::open(['route'=>'banner.store','enctype' => 'multipart/form-data']) !!}
                {!! FormField::file('image') !!}
                {!! FormField::text('title', ['label' => 'Title*', 'required' => true]) !!}
                {!! FormField::textarea('description', ['label' => 'Deskripsi','id'=>'editor']) !!}
                {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}

            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace('editor', {
        height  : '180px',
        filebrowserUploadUrl: "",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
