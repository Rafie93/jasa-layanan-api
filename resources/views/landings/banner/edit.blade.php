@extends('layouts.app')
@section('title', "Edit Banner")
@section('breadcrumb')
    <li><a href="{{Route("banner.index")}}">Banner</a></li>
    <li>Edit Banner</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Banner<small><i class="ace-icon fa fa-angle-double-right"></i>ubah data Banner guna untuk keperluan transfer pembayaran </small></h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Form Edit Banner</h3></div>
            <div class="panel-body">
                {!! Form::model($banner, ['route' => ['banner.update', $banner->id],'method' => 'post','enctype' => 'multipart/form-data']) !!}
                 <img src="{{$banner->image() }}" style="height: 100px" >
                {!! FormField::file('image') !!}
                {!! FormField::text('title', ['label' => 'Title*', 'required' => true,'value'=>$banner->title]) !!}
                {!! FormField::textarea('description', ['label' => 'Deskripsi','value'=>$banner->description,'id'=>'editor']) !!}
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
