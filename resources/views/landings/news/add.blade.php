@extends('layouts.app')
@section('title', "Tambah News")
@section('breadcrumb')
    <li><a href="{{Route("news.index")}}">News</a></li>
    <li>Tambah News</li>

@endsection
@section('content')
<div class="page-header">
    <h1> News<small><i class="ace-icon fa fa-angle-double-right"></i>tambahkan data News guna untuk menampilkan News pada app customer </small></h1>
</div>
{!! Form::open(['route'=>'news.store','enctype' => 'multipart/form-data']) !!}

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Title News</h3></div>
            <div class="panel-body">
                {!! FormField::file('thumbnail',['required'=>true]) !!}
                {!! FormField::text('title', ['label' => 'Judul Berita*', 'required' => true]) !!}
                {!! FormField::text('category', ['label' => 'Kategori Berita']) !!}
                {!! FormField::select('is_status',['0'=>'Draft','1'=>'Publish'],
                    [
                    'label' => 'Status',
                    'required' => true,
                    'value' => request('status') ?  request('status') : ''
                    ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Isi Berita</h3></div>
            <div class="panel-body">
                <textarea name="description" id="editor"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel-footer">
        {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}
    </div>
</div>

@endsection
@section('footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace('editor', {
        height  : '190px',
        filebrowserUploadUrl: "",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
